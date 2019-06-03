<?php

Class AskType implements JsonSerializable{
    // Properties
    private $id;
    private $name; // varchar 255

    // Constructor
    public function __construct(?int $id, string $name){
        $this->id = $id;
        $this->getName($name);
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setName(string $name) { 
        if(StringIsNotOver($name, 255)
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