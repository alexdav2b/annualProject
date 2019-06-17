<?php

require_once __DIR__ . '/../Model/Site.php';
// require_once __DIR__ . '/../Control/SiteController.php';
Class User{
	// Propriety
	private $id;  
	private $email; 
	private $name; 
	private $password; // hash
	private $numero;
	private $rue;
	private $postcode;
	private $area; 
	private $eligibility;
	private $site;

	// Constructor
	public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, bool $eligibility, Site $site){
		$this->id = $id;
		$this->email = $email;
		$this->name = $name;
		$this->password = $password;
		$this->numero = $numero;
		$this->rue = $rue;
		$this->area = $area;
		$this->postcode = $postcode;
		$this->eligibility = $eligibility;
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
	public function getEligibility(): bool{ return $this->eligibility; }
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
			'Eligibility' => $this->eligibility,
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
			'Eligibility' => $this->eligibility,
			'SIRET' => $siret, 
			'Salary' => $salary,
			'Discriminator' => $discriminator);
		$json = json_encode($array);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
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
			'Eligibility' => $this->eligibility,
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

	public function Connexion($fields): User{
		session_start();
		session_regenerate_id();
		$_SESSION['name'] = getName();
		// if (!isset($_SESSION['userId'])) {
        //     $_SESSION['userId'] = 0;
        // } else {
        //     $_SESSION['userId']++;
        // }
	}

	public function Inscription(){
		
	}

    public function Deconnnexion(){
        session_start();
        session_destroy ();
	}
	
	public function PasswordIsValid(string $password, string $hashedPassword): bool{
        $salt = substr($hashedPassword, 0, 10);
        $password = HashNSalt($password, $salt);
        return ($password == $hashedPassword);
    }
}

?>