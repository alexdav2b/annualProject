<?php

    class Conducteur{
        
        private $id;
        private $nom;
        private $prenom;

        public function __construct( ? int $id, ? string $nom,? string $prenom ){
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }
        
        public function getId(){ return $this->id; }
        public function getNom(){ return $this->nom; }
        public function getPrenom(){ return $this->prenom; }

        public function setChauffeur($id, $nom, $prenom){
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }
        
        public function __toString(){
            $res = 
            'id : '.$this->id.'<br>'.
            'Nom : '.$this->nom.'<br>'.
            'Prenom : '.$this->prenom;
            return $res;
        }

    }

?>
