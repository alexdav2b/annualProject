<?php

Class Adhesion implements JsonSerializable{
    // Properties
    private $id;
    private $userId;
    private $dateAdhesion;
    private $cb; // char 16
    private $code;

    // Constructor
    public function __construct(?int $id, int $userId, date $dateAdhesion, string $cb, int $code){
        $this->id = $id;
        $this->userId = $userId;
        $this->dateAdhesion = $dateAdhesion;
        $this->cb = $cb;
        $this->code = $code;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getUserId(): int { return $this->userId; }
    public function getDateAdhesion(): date { return $this->dateAdhesion; }
    public function getCB(): string { return $this->cb; }
    public function getCode(): int { return $this->code; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setUserId(int $id){ $this->userId = $id; }
    public function setDateAdhesion(date $date){ $this->dateAdhesion = $date; }
    public function setCB(string $cb){ $this->cb = $cb; }
    public function setCode(int $code){ $this->code = $code; }
    
    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>