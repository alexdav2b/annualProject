<?php

Class StopProduct implements JsonSerializable { // Verif BDD
    // Properties
    private $productId;
    private $stopId;

    // Constructor
    public function __construct(int $productId, int $stopId){
        $this->productId = $productId;
        $this->stopId = $stopId;
    }

    // Getter
    public function getProductId(): int { return $this->productId; }
    public function getStopId(): int {return $this->stopId; }

    // Setter
    public function setProductId(int $id){ $this->productId = $id; }
    public function setStopId(int $id){ $this->stopId = $id; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>