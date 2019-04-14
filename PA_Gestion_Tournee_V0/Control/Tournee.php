<?php

    require_once __DIR__ . '/PointDePassage.php';

    class Tournee {
        private $adresses;
        private $nb;
        private $date;
        private $chauffeur;

        public function __construct ($date = null){
            $this->adresses = array(); 
            $this->nb = 0;
            $this->date = $date;
            $this->chauffeur = new Conducteur (NULL , NULL, NULL);
            
        }

        public function getAdresse($indice){return $this->adresses[$indice] ;}
        public function getNb(){return $this->nb ;}
        public function getDate(){return $this->date ; }

        public function addPoint(PointDePassage $temp){
            // for($i = 0 ; $i < $this->nb ; $i++){
            //     if($this->adresse[$i] = null){
            //         $this->adresse[$i] = $temp;
            //     }
            // }
            echo $temp;
        }

        //créer une méthode pour remplir le tableau de point de passage et mettre à jour le nb

        public function __toString(){
            $points = '';
            $i = 0;
            for($i=0 ; $i<$this->nb ; $i++){
                $points .=  'Nom : '.$this->adresses[i]->nom.
                '<br>Adresse : '.$this->adresses[i]->adresse.
                '<br>Code Postale : '.$this->adresses[i]->codePostale. 
                '<br>Ville : '.$this->adresses[i]->ville.'<br>';
            }
            return $points.'<br>'.
                $this->nb.'<br>'.
                $this->date;

        }

    }

?>