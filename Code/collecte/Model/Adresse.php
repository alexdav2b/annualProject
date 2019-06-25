<?php 

    class Adresse{
        
        private $nom;
        private $numero;
        private $rue;
        private $codePostale;
        private $ville;

        public function __construct( ?string $nom, ?string $numero , ?string $rue , ?String $codePostale, ?string $ville ){
            $this->nom = $nom;
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostale = $codePostale;
            $this->ville = $ville;
        }

        public function getNom(){return $this->nom; }
        public function getNumero(){return $this->numero;}
        public function getRue(){return $this->rue; }
        public function getCodePostale(){return $this->codePostale; }
        public function getVille(){return $this->ville; }

        public function setAdresse( string $nom , string $numero, string $rue , String $codePostale, string $ville ){
            $this->nom = $nom;
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostale = $codePostale;
            $this->ville = $ville;
        }

        public function __toString(){
            return 'Nom : '.$this->nom.
                '<br>Numero : '.$this->numero.
                '<br>Adresse : '.$this->rue.
                '<br>Code Postale : '.$this->codePostale. 
                '<br>Ville : '.$this->ville;
        }

    }

?>