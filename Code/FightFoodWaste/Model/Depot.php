<?php

    require_once __DIR__ . '/Adresse.php';

    class Depot{

        private $ID;
        private $numero;
        private $rue;
        private $codePostal;
        private $ville;
        private $capacite;

        public function __construct(int $id, String $numero, String $rue, String $codePostal, String $ville, int $capacite){
            $this->ID = $id;
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->capacite = $capacite;
        }

        public function getID(){
            return $this->ID;
        }

        public function getNumero(){return $this->numero;}
        public function getRue(){return $this->rue;}
        public function getCode(){return $this->codePostal;}
        public function getVille(){return $this->ville;}
        
        public function getAddress(string $ad): string{
            return $this->getNumero().' '.$this->getRue().' '.$this->getPostcode().' '.$this->getArea();
        }

        public function setDepot(int $id, String $numero, String $rue, String $codePostal, String $ville, int $capacite){
            $this->ID = $id;
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->capacite = $capacite;
        }
        
        public function __toString(){
            $res = "Id : ".$this->ID."<br>".
                "Adresse : ".$this->numero." ".$this->rue."<br>".
                "Code postale : ".$this->codePostal."<br>".
                "Ville : ".$this->ville."<br>".
                "Capacité : ".$this->capacite."<br>" ;
            return $res;
        }
    }

?>