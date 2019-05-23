<?php

Class Site implements JsonSerializable{
    // Properties
    private $id;
    private $name;
    private $address; // modifier (postCode, area...)


    // Constructeur
    public function __construct(?int $id, string $name, string $adress){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }

    // Getter
    public function getId():? int{ return $this->id; }
    public function getAddress(): string {return $this->address; }
    public function getName(): string {return $this->name; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setAddress(string $address){ $this->address = $address; }
    public function setName(string $name){ $this->name = $name; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>