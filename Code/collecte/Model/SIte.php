<?php

    class Site{

        private $ID;
        private $ville;

        public function __construct($id, $ville){
            $this->ID = $id;
            $this->ville = $ville;
        }

        public function getId(){
            return $this->ID;
        }

        public function getVille(){
            return $this->ville;
        }

        public function __toString(){
            $res = "ID : ".$this->ID."<br>".
                "Ville : ".$this->ville."<br>";
            return $res;
        }

    }

?>