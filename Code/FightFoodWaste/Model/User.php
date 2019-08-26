<?php

require_once __DIR__ . '/../Model/Site.php';
// require_once __DIR__ . '/../Control/SiteController.php';
Class User implements JsonSerializable{
	// Propriety
	private $id;  
	private $email; 
	private $name; 
	private $password; // hash
	private $numero;
	private $rue;
	private $postcode;
	private $area; 
	private $site;

	// Constructor
	public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, Site $site){
		$this->id = $id;
		$this->email = $email;
		$this->name = $name;
		$this->password = $password;
		$this->numero = $numero;
		$this->rue = $rue;
		$this->area = $area;
		$this->postcode = $postcode;
		$this->site = $site;
	}

	// Get
	public function getId(): ?int{ return $this->id; }
	public function getEmail(): string{ return $this->email; }
	public function getName(): string{ return $this->name; }
	public function getPassword(): string{ return $this->password; }
    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostCode(): string { return $this->postcode; }
	public function getArea(): string { return $this->area; }
	public function getSite(): Site { return $this->site; }

	public function getDiscriminator() : string{
		$api = new ApiManager('Usr');
		$json = $api->getById($this->id);
		return $json['Discriminator'];
	}

	// Set
	public function setId($id){ $this->id = $id; }

	public function setNumero(string $numero){
        if($this->StringIsNotOver($numero, 5))
            $this->numero = $numero;
    }

    public function setRue(string $rue){
        if($this->StringIsNotOver($rue, 80))
            $this->rue = $rue;
    }

    public function setPostcode(string $postcode){ 
        if(strlen($postcode) == 5)
            $this->postcode = $postcode; 
    }

    public function setArea(string $area){
        if($this->StringIsNotOver($area, 80))
            $this->area = $area;
	}
	
	public function setSite(int $siteId){
		$controller = new SiteController();
		$site = $controller->getById($siteId);
		$this->site = $site;
	}

	public function setPassword(string $password){
		$salt = bin2hex(random_bytes(5)); // 10 characters
		$this->password = $this->HashNSalt($salt,  $password); // 50 characters
    }

	// API
	public function create(string $discriminator) : bool{
		$api = new ApiManager('Usr');
		if($this->id != null){
			return false;
		}
		$surname = ($discriminator == 'Individual' || $discriminator == 'Employer' || $discriminator == 'Admin' || $discriminator == 'Volunteer') ? $this->getSurname() : NULL;
		$siret = ($discriminator == 'Saleman') ? $this->getSiret() : null;
		$salary = ($discriminator == 'Employer') ? $this->getSalary() : null;
		
		$array = array(
			'SiteID' => $this->site->getId(),
			'Email' => $this->email,
			'Name' => $this->name,
			'Surname' => $surname,
			'Password' => $this->password,
			'Numero' => $this->numero,
			'Rue' => $this->rue,
			'Postcode' => $this->postcode,
			'Area' => $this->area,
			'SIRET' => $siret, 
			'Salary' => $salary,
			'Discriminator' => $discriminator);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Usr');
		$json = $api->delete($this->id);
		return $json['Success'];
	}

	public function update(string $discriminator): bool{
		$api = new ApiManager('Usr');
		$surname = ($discriminator == 'Individual' || $discriminator == 'Employer' || $discriminator == 'Admin' || $discriminator == 'Volunteer') ? $this->getSurname() : NULL;
		$siret = ($discriminator == 'Saleman') ? $this->getSiret() : null;
		$salary = ($discriminator == 'Employer') ? $this->getSalary() : null;
		$array = array(
			'ID' => $this->id,
			'SiteID' => $this->site->getId(),
			'Email' => $this->email,
			'Name' => $this->name,
			'Surname' => $surname,
			'Password' => $this->password,
			'Numero' => $this->numero,
			'Rue' => $this->rue,
			'Postcode' => $this->postcode,
			'Area' => $this->area,
			'SIRET' => $siret, 
			'Salary' => $salary,
			'Discriminator' => $discriminator);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}

	// Methodes
    private function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
	}
	
	public function PasswordIsValid(string $password, string $hashedPassword): bool{
		$salt = substr($hashedPassword, 0, 10);
		$password = $this->HashNSalt($salt, $password);
        return ($password == $hashedPassword);
	}

	private function HashNSalt(string $salt, string $password): string{
        // in DATABASE :  10st characters = SALT, 40 last = hash (SALT + PASSWORD)
        // ripemd160 => 40 characters
        $salted = $salt . $password; 
        $algo = 'ripemd160'; 
        $hashed = hash($algo, $salted, FALSE);
        $password = $salt . $hashed; 
        return $password;
	}
	
	public function jsonSerialize(){
		return get_object_vars($this);
	}

}

?>