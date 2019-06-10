<?php 

    class PointDePassage{
        
        private $nom;
        private $adresse;
        private $codePostale;
        private $ville;

        public function __construct($nom , $adresse , $codePostale, $ville ){
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->codePostale = $codePostale;
            $this->ville = $ville;

        }

        public function getNom(){return $this->nom; }
        public function getAdresse(){return $this->adresse; }
        public function getCodePostale(){return $this->codePostale; }
        public function getVille(){return $this->ville; }

        public function __toString(){
            return 'Nom : '.$this->nom.
                '<br>Adresse : '.$this->adresse.
                '<br>Code Postale : '.$this->codePostale. 
                '<br>Ville : '.$this->ville;
        }

    }

?>