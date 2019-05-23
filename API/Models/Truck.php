<?php

Class Truck implements JsonSerializable{
    // Property
    private $id;
    private $siteId;
    private $plate; // varchar 8
    private $name;
    private $capacity;

    // Constructor
    public function __construct(?int $id, int $siteId, string $p, string $n, int $c){
        $this->id = $id;
        $this->siteId = $siteId;
        $this->plate = $p;
        $this->name = $n;
        $this->capacity = $c;
    }

    // Getter
    public function getId(): ?int {return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getPlate(): string { return $this->plate; }
    public function getName(): string { return $this->name; }
    public function getCpacity(): int {return $this->capacity; }

    // Setter
    public function setId(int $id){ $this->id = $id;  }
    public function setSiteId(int $id){ $this->siteId = $id; }
    public function setPlate(string $plate){ $this->plate = $plate; }
    public function setName(string $name){ $this->name = $name; }
    public function setCapacity(int $number) { $this->capacity = $number; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>