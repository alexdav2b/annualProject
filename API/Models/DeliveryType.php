<?php

Class DeliveryType implements JsonSerializable{
    // Properties
    private $id;
    private $name; // VARCHAR 80

    // Constructor
    public function __construct(?int $id, string $name){
        $this->id = $id;
        $this->setName($name);
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setName(string $name){
        if($this->StringIsNotOver($name, 80))
            $this->name = $name;
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