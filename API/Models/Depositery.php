<?php

Class Depositery implements JsonSerializable{
    // Properties
    private $id;
    private $siteId;
    private $numero;
    private $rue;
    private $postcode;
    private $area;
    private $capacity;

    // Constructor
    public function __construct(?int $id, int $siteId, string $numero, string $rue, string $postcode, string $area, int $capacity){
        $this->id = $id;
        $this->siteId = $siteId;
        $this->setNumero($numero);
        $this->setRue($rue);
        $this->setPostcode($postcode);
        $this->setArea($area);
        $this->setCapacity($capacity);
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostcode(): string { return $this->postcode; }
    public function getArea(): string { return $this->area; }
    public function getCapacity(): int{ return $this->capacity; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setCapacity(int $capacity){ 
        if($capacity > 0)
            $this->capacity = $capacity; 
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