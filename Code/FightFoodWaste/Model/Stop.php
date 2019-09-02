<?php

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Delivery.php';


Class Stop implements JsonSerializable{
    private $id;
    private $date;
    private $delivery;
	private $user;
	private $coo;

    public function __construct(?int $id, $date, int $deliveryId, User $user){
        $this->id = $id;
        $this->date = $date;
        $this->delivery = $deliveryId;
        $this->user = $user;
    }

    public function getId(): ?int{ return $this->id; }
    public function getDate() { return $this->date; }
    public function getDelivery(): int { return $this->delivery; }
	public function getUser(): User{ return $this->user; }
	public function getCoo(): string{ return $this->coo; }

    public function setId(int $id){ if($id > 0){ $this->id = $id; } }
    public function setDate($date){ $this->date = $date; }
    public function setDelivery(int $deliveryId){ $this->delivery = $deliveryId; }

    public function setUser(int $userId){
		$controller = new UserController();
		$user = $controller->getById($userId);
		$this->user = $user;
	}

	public function setCoo(int $lng, int $lat){
		$coo = "$lng , $lat";
	}

    public function create(){
        $api = new ApiManager('Stop');
		if($this->id != null){
			return false;
		}
		$array = array(
			'DateHour' => $this->date,
			'DeliveryID' => $this->delivery,
			'UsrID' => $this->user->getId());
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
    }

	public function delete(): bool{
		$api = new ApiManager('Stop');
		
		// Supprimer tous les StopProduct associés 
		$apiStopProduct = new ApiManager('Stop_Product');
		$allStopProduct = $apiStopProduct->getByInt('Stop_Product', $this->id);
		foreach($allStopProduct as $object){
			$json = $apiStopProduct->delete($json['ID']);
			if($json['Success'] != true)
				return false;
		}

		$json = $api->delete($this->id);
		return $json['Success'];
	}
	
	public function update(string $discriminator): bool{
		$api = new ApiManager('Stop');
		$array = array(
			'ID' => $this->id,
			'DateHour' => $this->date,
			'DeliveryID' => $this->delivery,
			'UsrID' => $this->user->getId());
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}

	public function jsonSerialize(){
		return get_object_vars($this);
	}
}

?>