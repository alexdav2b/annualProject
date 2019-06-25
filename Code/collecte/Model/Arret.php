<?php

    require_once __DIR__ . '/Adresse.php';

    class Arret extends Adresse{
        
        private $nbArticle;

        public function __construct( ?string $nom ,?String $numero , ?string $rue , ?String $codePostale, ?string $ville, ?int $nbArticle ){
            parent::__construct($nom, $numero ,$rue, $codePostale, $ville);
            $this->nbArticle = $nbArticle;
        }

        public function getNb(){
            return $this->nbArticle;
        }

        public function setNb($nb){
            $this->nbArticle = $nb;
        }

        public function __toString(){
            $res ="Nb articles ici : ".$this->nbArticle."<br>";
            $res .=parent::__toString();
            return $res;
        }

    }


?>