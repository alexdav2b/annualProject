<?php

Class Product  implements JsonSerializable{
    // Property
    private $id;
    private $depositeryId;
    private $name;
    private $barcode;
    private $validDate;

    // Constructor
    public function __construct(?int $id, int $depositeryId, string $name, string $barcode, date $validDate){
        $this->id = $id;
        $this->depositeryId = $depositeryId;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->validDate = $validDate;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDepositeryId(): int { return $this->DepositeryId; }
    public function getName(): string { return $this->name; }
    public function getBarcode(): string { return $this->barcode; }
    public function getValidDate(): date{ return $this->validDate; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setDepositeryId(int $id) { $this->depositeyrId; }
    public function setName(string $name){ $this->name = $name; }
    public function setBarcode(string $barcode){ $this->barcode = $barcode; }
    public function setValidDate(date $date){ $this->validDate = $date; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>