<?php

Class Truck implements JsonSerializable{
    // Property
    private $id;
    private $siteId;
    private $plate; // varchar 8
    private $name; // varchar 80
    private $capacity; // sup 0

    // Constructor
    public function __construct(?int $id, int $siteId, string $p, string $n, int $c){
        $this->id = $id;
        $this->siteId = $siteId;
        $this->setPlate($p);
        $this->setName($n);
        $this->setCapacity($c);
    }

    // Getter
    public function getId(): ?int {return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getPlate(): string { return $this->plate; }
    public function getName(): string { return $this->name; }
    public function getCapacity(): int {return $this->capacity; }

    // Setter
    public function setId(int $id){ $this->id = $id;  }
    public function setSiteId(int $id){ $this->siteId = $id; }

    public function setName(string $name){ 
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }

    public function setCapacity(int $number) { 
        if($number > 0)
            $this->capacity = $number; 
        }

    public function setPlate(string $plate){ 
        if($this->StringIsNotOver($plate, 8))
            $this->plate = $plate; 
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