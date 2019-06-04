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


    // Setter
    public function setStopId(int $id){ $this->stopId = $id; }
    public function setProductId(int $id){ $this->productId = $id; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>