<?php

require_once __DIR__ . '/../Model/Site.php';

Class Truck{

    private $id;
    private $plate;
    private $name;
    private $capacity;
    private $site;

    public function __construct(?int $id, string $plate, string $name, int $capacity, Site $site){
        if($id > 0)
            $this->id = $id;
        if($this->StringIsNotOver($plate, 8))
            $this->plate = $plate; 
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
        if($capacity > 0)
            $this->capacity = $capacity;
        if($site != null){
            $this->site = $site;
        }
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
        if($this->StringIsNotOver($plate, 8))
        $this->plate = $plate;     
    }

    public function setName(string $name){
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }
        
    public function setCapacity(int $number){
        if($number > 0)
            $this->capacity = $number;
    }

    public function setSite(Site $site){
        if($site != null){
            $this->site = $site;
        }
    }

    // Method

    private function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
    }

    public function create(string $discriminator) : bool{
		$api = new ApiManager('Truck');
		if($this->id != null){
			return false;
		}
		$json = array(
			'ID' => NULL, 
            'SiteID' => $this->site->getId(),
			'Plate' => $this->plate,
			'Name' => $this->name,
            'Capacity' => $this->capacity);
		$json = json_encode($this);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Site');
		$json = json_encode($this);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
	}
	public function update(string $discriminator): bool{
		$api = new ApiManager('Site');
        $json = array(
            'ID' => $this->id, 
            'SiteID' => $this->site->getId(),
            'Plate' => $this->plate,
            'Name' => $this->name,
            'Capacity' => $this->capacity);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}

}