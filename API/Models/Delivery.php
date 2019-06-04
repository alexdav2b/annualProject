<?php

Class Delivery implements JsonSerializable{
    // Properties
    private $id; 
    private $truckId;
    private $deliveryTypeId; 
    private $dateStart; // nullable
    private $dateEnd; // nullable

    // Constructor
    public function __construct(?int $id, int $truckId, int $deliveryTypeId, date $dateStart, date $dateEnd){
        $this->id = $id;
        $this->truckId = $truckId;
        $this->deliveryTypeId = $deliveryTypeId;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getTruckId(): int { return $this->truckId = $truckId; }
    public function getDeliveryTypeId(): int { return $this->deliveryTypeId; }
    public function getDateStart(): date { return $this->dateStart; }
    public function getDateEnd(): date { return $this->dateEnd; } 

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setTruckId(int $id){ $this->truckId = $id; }
    public function setDeliveryTypeId(int $id){ $this->deliveryTypeId = $id; }
    public function setDateStart(date $date){ $this->dateStart; }
    public function setDateEnd(date $date){ $this->dateEnd; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>