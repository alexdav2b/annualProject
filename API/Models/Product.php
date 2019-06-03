<?php

Class Product  implements JsonSerializable{
    // Property
    private $id;
    private $depositeryId; 
    private $name; // VARCHAR 80
    private $barcode; // VARCHAR 13
    private $validDate; // date => fonction de validation

    // Constructor
    public function __construct(?int $id, ?int $depositeryId, string $name, string $barcode, string $validDate){
        $this->id = $id;
        $this->depositeryId = $depositeryId;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->validDate = $validDate;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDepositeryId(): ?int { return $this->depositeryId; }
    public function getName(): string { return $this->name; }
    public function getBarcode(): string { return $this->barcode; }
    public function getValidDate(): string{ return $this->validDate; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setDepositeryId(int $id) { $this->depositeryId; }
    public function setValidDate(string $date){ $this->validDate = $date; }

    public function setName(string $name){ 
        if(StringIsNotOver($name, 80))
            $this->name = $name; 
        }

    public function setBarcode(string $barcode){
        if(StringIsNotOver($barcode, 13))
            $this->barcode = $barcode;
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