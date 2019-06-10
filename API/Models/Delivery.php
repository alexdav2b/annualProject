<?php

Class Delivery implements JsonSerializable{
    // Properties
    private $id;
    private $truckId;
    private $userId;
    private $deliveryTypeId;
    private $dateStart; // nullable
    private $dateEnd; // nullable

    // Constructor
    public function __construct(?int $id, int $truckId, int $userId, int $deliveryTypeId, ?string $dateStart, ?string $dateEnd){
        $this->id = $id;
        $this->userId = $userId;
        $this->truckId = $truckId;
        $this->deliveryTypeId = $deliveryTypeId;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getUserId(): ?int { return $this->userId; }
    public function getTruckId(): int { return $this->truckId; }
    public function getDeliveryTypeId(): int { return $this->deliveryTypeId; }
    public function getDateStart(): ?string { return $this->dateStart; }
    public function getDateEnd(): ?string { return $this->dateEnd; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    // public function setDateStart(string $date){ $this->dateStart; }
    // public function setDateEnd(string $date){ $this->dateEnd; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>
