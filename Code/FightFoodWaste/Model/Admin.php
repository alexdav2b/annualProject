<?php

require_once __DIR__ . '/../Model/User.php';

Class Admin extends User{
    private $salary;
    private $surname;

    public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, float $salary, string $surname, Site $site){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $site);
        $this->salary = $salary;
        $this->surname = $surname;
    }

    public function getSalary(): float{ return $this->salary; }
    public function getSurname(): string { return $this->surname; }

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

    public function createAdmin(): bool{
        return parent::create('Admin');
    }

    public function updateAdmin(): bool{
        return parent::update('Admin');
    }
}

?>