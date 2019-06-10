<?php

Class StopProduct implements JsonSerializable { // Verif BDD
    // Properties
    private $stopId;
    private $productId;

    // Constructor
    public function __construct(int $stopId, int $productId){
        $this->stopId = $stopId;
        $this->productId = $productId;
    }

    // Getter
    public function getStopId(): int {return $this->stopId; }
    public function getProductId(): int { return $this->productId; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>