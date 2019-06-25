<?php

    class Conducteur{
        
        private $id;
        private $nom;
        private $prenom;
        private $email;

        public function __construct( ? int $id, ? string $nom,? string $prenom , string $email){
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
        }
        
        public function getId(){ return $this->id; }
        public function getNom(){ return $this->nom; }
        public function getPrenom(){ return $this->prenom; }
        public function getEmail(){return $this->email ;} 

        public function setChauffeur($id, $nom, $prenom, $email){
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
        }
        
        public function __toString(){
            $res = 
            'id : '.$this->id.'<br>'.
            'Nom : '.$this->nom.'<br>'.
            'Prenom : '.$this->prenom.'<br>'.
            'Email : '.$this->email;

            return $res;
        }

    }

?>
