<?php

Class Stop implements JsonSerializable{
    // Properties
    private $id;
    private $dateHour; // nullable => date
    private $deliveryId; // nullable
    private $donatorId; // OBLIGATOIRE
    private $receiverId; // nullable

    // Constructor
    public function __construct(?int $id, ?string $dateHour, ?int $deliveryId, int $donatorId, ?int $receiverId){
        $this->id = $id;
        $this->dateHour = $dateHour;
        $this->deliveryId = $deliveryId;
        $this->donatorId = $donatorId;
        $this->receiverId = $receiverId;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDateHour(): ?string { return $this->dateHour; }
    public function getDeliveryId(): ?int { return $this->deliveryId; }
    public function getDonatorId(): int { return $this->donatorId; }
    public function getReceiverId() : ?int { return $this->receiverId; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setDateHour(string $dateHour){ $this->dateHour = $dateHour; }
    public function setDeliveryId(int $id){ $this->deliveryId = $id; }
    public function setDonatorId(int $id) { $this->donatorId = $id; }
    public function setReceiverId(int $id){ $this->receiverId = $id; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>