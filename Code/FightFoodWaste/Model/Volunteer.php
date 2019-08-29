<?php

require_once __DIR__ . '/../Model/User.php';

Class Volunteer extends User{

    private $surname;
    private $permis;
    private $libre;

    public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, string $surname, Site $site, bool $permis, bool $libre){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $site);
        $this->surname = $surname;
    }

    public function getSurname(): string { return $this->surname; }
    public function setSurname(string $surname){
        if(strlen($surname) > 0 && strlen($surname) <= 80){
            $this->surname = $surname;
        }
    }
    public function getPermis():boolean { return $this->permis; }
    public function getLibre(): boolean { return $this->libre; }

    public function setLibre(bool $b){ $this->libre = $b; }
    public function setPermis(bool $b) { $this->permis = $b; }

    public function createVolunteer(): bool{
        return parent::create('Volunteer');
    }

    public function updateVolunteer(): bool{
        return parent::update('Volunteer');
    }
}

?>