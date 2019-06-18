<?php

    require_once __DIR__ . '/Adresse.php';
    require_once __DIR__ . '/Conducteur.php';
    require_once __DIR__ . '/Vehicule.php';
    require_once __DIR__ . '/Article.php';


    class Tournee {
        private $adresses;
        private $articles;
        private $adresseDepot;
        private $nbArret;
        private $nbArticle;
        private $date;
        private $chauffeur;
        private $vehicule;

        public function __construct ($date = null){
            $this->adresses = array(); 
            $this->articles = array();
            $this->adresseDepot = new Adresse (NULL, NULL, NULL, NULL, NULL);
            $this->nbArret = 0;
            $this->nbArticle = 0;
            $this->date = $date;
            $this->chauffeur = new Conducteur (NULL , NULL, NULL);
            $this->vehicule = new Vehicule ( NULL, NULL, NULL, NULL );
        }

        public function getAdresse($indice){return $this->adresses[$indice] ;}
        public function getNb(){return $this->nb ;}
        public function getDate(){return $this->date ; }

        public function addAdresse(Adresse $p){
            $this->adresses[$this->nb] = $p;
            $this->nb = $this->nb + 1;
        }

        /*

        - créer une méthode pour transformer mon array et array de Adresse
        - créer une méthode qui ajoute un nouvel arrêt + incrémentation du nombre d'arrêt
        - finir la méthode toString
        - créer une méthode pour enlevé un élèment du parcours (avec dé-incréentation du $nb)
        - 
        
        */

        public function __toString(){
            $points = '';
            $i = 0;
            $n = 0;
            for($i=0 ; $i<$this->nb ; $i++){
                $n = $i +1 ;
                echo "Adresse n°".$n."<br>";
                echo $this->adresses[$i]."<br>";
                echo "<br>";
            }
            return $points.
                $this->nb.'<br>'.
                $this->date;

        }

    }

?>