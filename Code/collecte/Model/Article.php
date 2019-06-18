<?php

    class Article{

        private $ID;
        private $nom;
        private $codeBar;
        private $IdUsrDonated;

        public function __construct(int $id, String $nom, String $codeBar, int $IdUsrDonated){
            $this->ID = $id;
            $this->nom = $nom;
            $this->codeBar = $codeBar;
            $this->IdUsrDonated = $IdUsrDonated;
        }

        public function setArticle(int $id, String $nom, String $codeBar, int $IdUsrDonated){
            $this->ID = $id;
            $this->nom = $nom;
            $this->codeBar = $codeBar;
            $this->IdUsrDonated = $IdUsrDonated;
        }

        public function getId(){
            return $this->ID;
        }
        public function getNom(){
            return $this->nom;
        }
        public function getCodeBar(){
            return $this->codeBar;
        }
        public function getIdUsrDonated(){
            return $this->IdUsrDonated;
        }

        public function __toString(){
            $res = "Id : ".$this->ID."<br>".
            "Nom : ".$this->nom."<br>".
            "Code Bar : ".$this->codeBar."<br>".
            "Donné par l'utilisateur id : ".$this->IdUsrDonated."<br>";
            return $res;
        }


    }


?>