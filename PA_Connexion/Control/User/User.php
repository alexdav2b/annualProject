<?php

Class User{
	// Propriety
	private $id; // obligatoire
	private $email; // obligatoire
	private $name; // pas obligatoire
	private $surname;  // pas obligatoire
	private $password; // obligatoire
	private $address; // obligatoire
	private $eligibility;
	
	private $siteId; // Choisit la région lors de la connexion
	private $askId; //
	private $serviceId; // Employee
	private $name2;	// CompanyName
	private $siret;
	private $discriminator;

	// Constructor
	public function __construct(?int $id, string $email, string $name, string $surname, string $password, string $address, bool $eligibility){
		$this->id = $id;
		$this->email = $email;
		$this->name = $name;
		$this->surname = $surname;
		$this->password = $password;
		$this->address = $address;
		$this->eligibility = $eligibility;
	}

	// Get
	public function getId():? int{ return $this->id; }
	public function getEmail(): string{ return $this->email; }
	public function getName(): string{ return $this->name; }
	public function getSurname(): string{ return $this->surname; }
	public function getPassword(): string{ return $this->password; }
	public function getAddress(): string{ return $this->address; }
	public function getEligibility(): bool{ return $this->eligibility; }

	public function getUserById($id){
	
	}

	public function getUserByName($name){

	}

	public function getUsers(){
		
	}

	// Set
	public function setId($id)
	{
		$this->id = $id;
	}

	// Methodes
	public function Connexion($fields): User{

	}

	public function Inscription(){

	}

	// tostring
	public function __tostring(){
		$str = $this->getId();
		$str .= $this->getEmail();
		$str .= $this->getName();
		$str .= $this->getSurname();
		$str .= $this->getPassword();
		$str .= $this->getAddress();
		$str .= $this->getEligibility();
		return $str;
	}
}

?>