<?php

    require_once __DIR__ . '/Adresse.php';
    require_once __DIR__ . '/Conducteur.php';
    require_once __DIR__ . '/Vehicule.php';
    require_once __DIR__ . '/Article.php';


    class Tournee {
        private $id;
        private $truck;
        private $UsrId;
        private $type;
        private $start;
        private $end;

        public function __construct (?int $id, ?int $truck, ?int $usrId, ?int $type, ?string $start, ?string $end){
            $this->id = $id;
            $this->truck = $truck;
            $this->UsrId = $usrId;
            $this->type = $type;
            $this->start = $start;
            $this->end = $end;
        }

        public function getStrat(){return $this->strat ; }

        /*

        - créer une méthode pour transformer mon array et array de Adresse
        - créer une méthode qui ajoute un nouvel arrêt + incrémentation du nombre d'arrêt
        - finir la méthode toString
        - créer une méthode pour enlevé un élèment du parcours (avec dé-incréentation du $nb)
        - 
        
        */

        public function __toString(){
            $res = 'Id : '.$this->id.
                '<br>Id véhicule : '.$this->truck.
                '<br>Usr id : '.$this->UsrId.
                '<br>Type : '.$this->type.
                '<br>Début : '.$this->start.
                '<br>Fin : '.$this->end ;
            return $res;
        }

    }

?>