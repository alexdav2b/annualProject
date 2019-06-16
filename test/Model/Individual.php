<?php

require_once __DIR__ . '/../Model/User.php';

Class Individual extends User{

    private $surname;

    public function __construct(int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, bool $eligibility, string $surname, Site $site){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $eligibility, $site);
        $this->surname = $surname;
    }

    public function getSurname(): string { return $this->surname; }
    public function setSurname(string $surname){
        if(strlen($surname) > 0 && strlen($surname) <= 80){
            $this->surname = $surname;
        }
    }

    public function createIndividual(): bool{
        return parent::create('Individual');
    }

    public function updateIndividual(): bool{
        return parent::update('Individual');
    }
}

?>