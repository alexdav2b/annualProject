<?php

require_once __DIR__ . '/../Model/User.php';

Class Saleman extends User{

    private $siret;

    public function __construct(?int $id, string $email, string $name, string $password, string $numero, string $rue, string $postcode, string $area, string $siret, Site $site){
        parent::__construct($id, $email, $name, $password, $numero, $rue, $postcode, $area, $site);
        if(strlen($siret) == 14){
            $this->siret = $siret;
        }
    }

    public function getSiret(): string { return $this->siret; }
    public function setSiret(string $siret){
        if(strlen($siret) == 14){
            $this->siret = $siret;
        }
    }

    public function createSaleman(): bool{
        return parent::create('Saleman');
    }

    public function updateSaleman(): bool{
        return parent::update('Saleman');
    }
}

?>