<?php

require_once __DIR__ . '/../Model/Site.php';

Class Truck{

    private $id;
    private $plate;
    private $name;
    private $capacity;
    private $site;

    public function __construct(?int $id, string $plate, string $name, int $capacity, Site $site){
        $this->id = $id;
        $this->plate = $plate; 
        $this->name = $name; 
        $this->capacity = $capacity;
        $this->site = $site;

    }

    public function getId(): ?int{ return $this->id; }
    public function getPlate() : string {return $this->plate; }
    public function getName(): string { return $this->name; }
    public function getCapacity(): int { return $this->capacity; }
    public function getSite(): Site { return $this->site; }


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
        
    public function setCapacity(int $number){
        if($number > 0)
            $this->capacity = $number;
    }

    public function setSite(int $siteId){
        $controller = new SiteController();
        $site = $controller->getById($siteId);
        $this->site = $site;
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
            'Capacity' => $this->capacity);
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
        $array = array(
			'ID' => $this->id, 
            'SiteID' => $this->site->getId(),
			'Plate' => $this->plate,
			'Name' => $this->name,
            'Capacity' => $this->capacity);
		$json = json_encode($array);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
	}
	public function update(string $discriminator): bool{
		$api = new ApiManager('Truck');
        $array = array(
			'ID' => $this->id, 
            'SiteID' => $this->site->getId(),
			'Plate' => $this->plate,
			'Name' => $this->name,
            'Capacity' => $this->capacity);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}

}