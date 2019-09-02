<?php

require_once __DIR__ . '/../Model/Site.php';

Class Truck implements JsonSerializable{

    private $id;
    private $plate;
    private $name;
    private $site;
    private $libre;

    public function __construct(?int $id, string $plate, string $name, Site $site, bool $libre){
        $this->id = $id;
        $this->plate = $plate; 
        $this->name = $name; 
        $this->site = $site;
        $this->libre = $libre;

    }

    public function getId(): ?int{ return $this->id; }
    public function getPlate() : string {return $this->plate; }
    public function getName(): string { return $this->name; }

    public function getSite(): Site { return $this->site; }
    public function getLibre(): bool {return $this->libre; }


    public function setId(int $id){ 
        if($id > 0)
            $this->id = $id; 
    }

    public function setPlate(string $plate){
        if(strlen($plate) > 0 && strlen($plate) <= 80)
        $this->plate = $plate;     
    }

    public function setName(string $name){
        if(strlen($name) >= 0 && strlen($name) <= 80)
            $this->name = $name; 
    }
        
 

    public function setSite(int $siteId){
        $controller = new SiteController();
        $site = $controller->getById($siteId);
        $this->site = $site;
    }

    public function setLibre(bool $libre){
        $this->libre = $libre;
    }
    // Method

    public function create(string $discriminator) : bool{
		$api = new ApiManager('Truck');
		if($this->id != null){
			return false;
		}
		$array = array(
            'SiteID' => $this->site->getId(),
			'Plate' => $this->plate,
			'Name' => $this->name,
            'Libre' => $this->libre);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Truck');
		$json = $api->delete($this->id);
		return $json['Success'];
	}
	public function update(string $discriminator): bool{
		$api = new ApiManager('Truck');
        $array = array(
			'ID' => $this->id, 
            'SiteID' => $this->site->getId(),
			'Plate' => $this->plate,
			'Name' => $this->name,
            'Libre' => $this->libre);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
    }

    public function isFreeForPeriod($dateStart, $dateEnd): bool{
        $deliveryC = new DeliveryController();
        $deliveries = $deliveryC->getByTruck($this);

        $beginTest = new DateTime($dateStart);
        $endTest = new DateTime($dateEnd);

        foreach($deliveries as $delivery){
            $beginDelivery = new DateTime($delivery->getDateStart());
            $endDelivery = new DateTime($delivery->getDateEnd());

            $isFree = Statique::isFreeForPeriod($beginTest, $endTest, $beginDelivery, $endDelivery);
            return $isFree;
        }
        return true;
    }

    public function jsonSerialize(){
		return get_object_vars($this);
	}

}

?>