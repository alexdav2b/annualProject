<?php

Class Adhesion implements JsonSerializable{
    // Properties
    private $id;
    private $userId;
    private $dateAdhesion; // varchar 255 & DATE
    private $cb; // char 16
    private $code; // char 3

    // Constructor
    public function __construct(?int $id, int $userId, string $dateAdhesion, string $cb, string $code){
        $this->id = $id;
        $this->userId = $userId;
        $this->dateAdhesion = $dateAdhesion;
        $this->cb = $cb;
        $this->code = $code;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->userId; }
    public function getDateAdhesion(): string { return $this->dateAdhesion; }
    public function getCB(): string { return $this->cb; }
    public function getCode(): int { return $this->code; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    // public function setDateAdhesion(date $date){ $this->dateAdhesion = $date; }

    public function setCB(string $cb){ 
        if(strlen($cb) == 16)
            $this->cb = $cb; 
    }
    
    public function setCode(string $code){ 
        if(strlen($code) == 16)
            $this->code = $code; 
        }
    
    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>