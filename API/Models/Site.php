<?php

Class Site implements JsonSerializable{
    // Properties
    private $id;
    private $name;
    private $numero;
    private $rue;
    private $postcode;
    private $area;

    // Constructeur
    public function __construct(?int $id, string $name, string $numero, string $rue, string $postcode, string $area){
        $this->id = $id;
        $this->setName($name);
        $this->setNumero($numero);
        $this->setRue($rue);
        $this->setPostcode($postcode);
        $this->setArea($area);
    }

    // Getter
    public function getId():? int{ return $this->id; }
    public function getName(): string { return $this->name; }
    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostcode(): string { return $this->postcode; }
    public function getArea(): string { return $this->area; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setName(string $name){
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }
        
    public function setNumero(string $numero){
        if($this->StringIsNotOver($numero, 5))
            $this->numero = $numero; 
    }

    public function setRue(string $rue){
        if($this->StringIsNotOver($rue, 80))
            $this->rue = $rue;   
    }

    public function setPostcode(string $postcode){
        if($this->StringIsNotOver($postcode, 80))
            $this->postcode = $postcode; 
    }

    public function setArea(string $area){
        if($this->StringIsNotOver($area, 80))
            $this->area = $area; 
    }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }

    private function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
    }
}

?>