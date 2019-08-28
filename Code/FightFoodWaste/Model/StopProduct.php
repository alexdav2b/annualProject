<?php

Class StopProduct{
    private $id;
    private $stopId;
    private $productId;

    public function __construct(?int $id, int $stopId, int $productId){
        $this->id = $id;
        $this->stopId = $stopId;
        $this->productId = $productId;
    }

    public function getId(): ?int{ return $this->id; }
    public function getStop(): ?int{ return $this->stopId; }
    public function getProduct(): ?int { return$this->productId; }

    public function setId(int $id){
        if($id > 0)
            $this->id = $id;
    }

    public function setProductId(int $id){
        if($id > 0)
            $this->productId = $id;
    }
        
    public function setStopId(int $id){
        if($id > 0)
            $this->stopId = $id;
    }

    public function create(){
        $api = new ApiManager('stop_product');
		if($this->id != null){
			return false;
		}
		$array = array(
            'StopID' => $this->stopId,
            'ProductID' => $this->productId);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
    }

	public function delete(): bool{
		$api = new ApiManager('stop_product');
		$json = $api->delete($this->id);
		return $json['Success'];
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('stop_product');
        $array = array(
			'ID' => $this->id,
            'StopID' => $this->stopId,
            'ProductID' => $this->productId);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
}