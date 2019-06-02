<?php

Class Depositery implements JsonSerializable{
    // Properties
    private $id;
    private $siteId;
    private $address;
    private $capacity;

    // Constructor
    public function __construct(?int $id, int $siteId, string $a, int $c){
        $this->id = $id;
        $this->siteId = $siteId;
        $this->address = $a;
        $this->capacity = $c;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getAddress(): string { return $this->address; }
    public function getCapacity(): int{ return $this->capacity; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setSiteId(int $id){ $this->siteId = $id; }
    public function setAddress(string $address){ $this->address = $address; }
    public function setCapacity(int $capacity){ $this->capacity = $capacity; }
    
    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>