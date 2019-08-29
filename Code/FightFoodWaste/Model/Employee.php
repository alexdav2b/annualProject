<?php

require_once __DIR__ . '/../Model/User.php';

Class Employee extends User implements JsonSerializable{
    private $salary;
    private $surname;
    private $permis;
    private $libre;

    public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, float $salary, string $surname, Site $site, bool $permis, bool $libre){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $site);
        $this->salary = $salary;
        $this->surname = $surname;
        $this->libre = $libre;
        $this->permis = $permis;
    }

    public function getSalary(): float{ return $this->salary; }
    public function getSurname(): string { return $this->surname; }
    public function getLibre() : bool { return $this->libre; }
    public function getPermis() : bool { return $this->permis; }

    public function setLibre(bool $b){
        $this->libre = $b;
    }

    public function setPermis(bool $b){
        $this->permis = $b;
    }

    public function setSalary(float $number){
        if($number > 0){
            $this->salary = $number;
        }
    }

    public function setSurname(string $surname){
        if(strlen($surname) > 0 && strlen($surname) <= 80){
            $this->surname = $surname;
        }
    }

    public function createEmployee(): bool{
        return parent::create('Employer');
    }

    public function updateEmployee(): bool{
        return parent::update('Employer');
    }

    public function jsonSerialize(){
		return get_object_vars($this);
	}
}

?>