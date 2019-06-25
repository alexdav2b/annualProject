<?php

    class Vehicule{

        private $id;
        private $imatriculation;
        private $name;
        private $capacite;

        public function __construct( ?int $id, ?string $imatriculation, ?string $name, ?int $capacite  ){
            $this->id = $id;
            $this->imatriculation = $imatriculation;
            $this->name = $name;
            $this->capacite = $capacite;
        }

        public function getId(){ return $this->id; }
        public function getImatriculation(){ return $this->imatriculation; }
        public function getMarque(){ return $this->name; }
        public function getModel(){ return $this->capacite; }

        public function __toString(){
            $res=
            'id ='.$this->id.
            '<br>Imatriculation : '.$this->imatriculation.
            '<br>Name : '.$this->name.
            '<br>capacite : '. $this->capacite ;
            return $res;

        }


    }


?>