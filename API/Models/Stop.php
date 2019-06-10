<?php

Class Stop implements JsonSerializable{
    // Properties
    private $id;
    private $dateHour; // nullable => date
    private $deliveryId; // nullable
    private $donateId; // OBLIGATOIRE
    private $receiveId; // nullable

    // Constructor
    public function __construct(?int $id, ?string $dateHour, ?int $deliveryId, int $donateId, ?int $receiveId){
        $this->id = $id;
        $this->dateHour = $dateHour;
        $this->deliveryId = $deliveryId;
        $this->donateId = $donateId;
        $this->receiveId = $receiveId;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDateHour(): ?string { return $this->dateHour; }
    public function getDeliveryId(): ?int { return $this->deliveryId; }
    public function getDonateId(): int { return $this->donateId; }
    public function getReceiveId() : ?int { return $this->receiveId; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    // public function setDateHour(string $dateHour){ $this->dateHour = $dateHour; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>