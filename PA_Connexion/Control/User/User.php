<?php

// require

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

	// Constructor
	public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, bool $eligibility){
		$this->id = $id;
		$this->email = $email;
		$this->name = $name;
		$this->password = $password;
		// $this->address = $address;
		$this->eligibility = $eligibility;
	}

	// Get
	public function getId():? int{ return $this->id; }
	public function getEmail(): string{ return $this->email; }
	public function getName(): string{ return $this->name; }
	// public function getSurname(): string{ return $this->surname; }
	public function getPassword(): string{ return $this->password; }

    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostCode(): string { return $this->postcode; }
	public function getArea(): string { return $this->area; }
	
	public function getEligibility(): bool{ return $this->eligibility; }

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

	// API
	public function create(){
		
	}
	public function delete(){

	}
	public function getALl(){

	}
	public function getByEmail(){

	}
	public function getById(){

	}
	public function update(){

	}

	// Methodes
	private function Json(string $url, ?array $data){
		$options = array(
			'http' => array(
			'method' => 'POST',
			'content' => json_encode( $data ),
			'header' => "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
			)
		);
		  
		$context  = stream_context_create($options);
		$post = file_get_contents($url, false, $context);
		$json = json_decode($post, true);
		foreach($json as $object){
			$user = new User($object->id, $object->email, $object->name, $object->password, $object->numero, $object->rue, $object->postcode, $object->area, $object->eligibility) ;
			array_push($result, $user);
		}
		return $result;
	}

	public function Connexion($fields): User{
		session_start();
		$_SESSION['name'] = getName();
	}

	public function Inscription(){

	}

	public function PasswordIsValid(string $password, string $hashedPassword): bool{
        $salt = substr($hashedPassword, 0, 10);
        $password = HashNSalt($password, $salt);
        return ($password == $hashedPassword);
    }

	// tostring
	public function __tostring(){
		$str = $this->getId();
		$str .= $this->getEmail();
		$str .= $this->getName();
		$str .= $this->getSurname();
		$str .= $this->getPassword();
		// $str .= $this->getAddress();
		$str .= $this->getEligibility();
		return $str;
	}
}

?>