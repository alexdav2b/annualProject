<?php

require_once __DIR__ . '/../Model/User.php';

Class Individual extends User implements JsonSerializable{

    private $surname;
    private $eligibility;
    public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, string $surname, Site $site, bool $eligibility){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $site);
        $this->surname = $surname;
        $this->eligibility = $eligibility;
    }

    public function getSurname(): string { return $this->surname; }
    public function getEligibility() :bool {return $this->eligibility;}
    public function setSurname(string $surname){
        if(strlen($surname) > 0 && strlen($surname) <= 80){
            $this->surname = $surname;
        }
    }

    public function setEligibility(bool $el){
        $this->eligibility = $el;
    }

    public function createIndividual(): bool{
        return parent::create('Individual');
    }

    public function updateIndividual(): bool{
        return parent::update('Individual');
    }

    public function jsonSerialize(){
		return get_object_vars($this);
	}
}

?>