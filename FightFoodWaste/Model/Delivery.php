<?php

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/DeliveryType.php';
require_once __DIR__ . '/../Model/Truck.php';

Class Delivery{

	private $id;
	private $truck;
	private $user;
	private $type;
	private $dateStart;
	private $dateEnd;
    
    public function __construct(?int $id, Truck $truck, ?User $user, DeliveryType $type, $dateStart, $dateEnd){
        $this->id = $id;
		$this->truck = $truck;
		$this->user = $user;
		$this->type = $type;
		$this->dateStart = $dateStart;
		$this->dateEnd = $dateEnd;
    }

    public function getId(): ?int{ return $this->id; }
	public function getTruck(): Truck{ return $this->truck; }
	public function getUser(): ?User{ return $this->user; }
	public function getType(): DeliveryType{ return $this->type; }
	public function getDateStart() { return $this->dateStart; }
	public function getDateEnd() { return $this->dateEnd; }

    public function setId(int $id){
        if($id > 0){
            $this->id = $id;
        }
    }
    
    public function setTruck(int $truckId){
		$controller = new TruckController();
		$truck = $controller->getById($truckId);
		$this->truck = $truck;
	}
	
	public function setUser(int $userId){
		$controller = new UserController();
		$user = $controller->getById($userId);
		$this->user = $user;
	}

	public function setType(int $deliveryTypeId){
		$controller = new DeliveryTypeController();
		$type = $controller->getById($deliveryTypeId);
		$this->type = $type;
	}

	public function setDateStart($date){
		$this->dateStart = $date;
	}

	public function setDateEnd($date){
		$this->dateEnd = $date;
	}

	// Database

    public function create(string $discriminator) : bool{
		$api = new ApiManager('Delivery');
		if($this->id != null){
			return false;
		}
		$array = array(
			'TruckID' => $this->truck->getId(),
			'UsrID' => $this->user->getId(),
			'DeliveryTypeID' => $this->type->getId(),
			'DateStart' => $this->dateStart,
			'DateEnd' => $this->dateEnd);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Delivery');
        $array = array(
            'ID' => $this->id, 
			'TruckID' => $this->truck->getId(),
			'UsrID' => $this->user->getId(),
			'DeliveryTypeID' => $this->type->getId(),
			'DateStart' => $this->dateStart,
			'DateEnd' => $this->dateEnd);
		$json = json_encode($array);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('Delivery');
        $array = array(
            'ID' => $this->id, 
			'TruckID' => $this->truck->getId(),
			'UsrID' => $this->user->getId(),
			'DeliveryTypeID' => $this->type->getId(),
			'DateStart' => $this->dateStart,
			'DateEnd' => $this->dateEnd);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
}