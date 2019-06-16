<?php

require_once __DIR__ . '/../Model/Site.php';

Class Depositery{
    private $id;
    private $site;
    private $numero;
    private $rue;
    private $postcode;
    private $area;
    private $capacity;

    public function __construct(?int $id, Site $site, string $numero, string $rue, string $postcode, string $area, int $capacity){
        $this->id = $id;
        $this->site = $site;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->postcode = $postcode;
        $this->area = $area;
        $this->capacity = $capacity;
    }

    public function getId(): ?int{ return $this->id; }
    public function getSite(): Site{ return $this->site; }
    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostcode() : string { return $this->postcode; }
    public function getArea() : string { return $this->area; }
    public function getCapacity() : int { return $this->capacity; }

    public function setId(int $id){
        if($id > 0)
            $this->id = $id;
    }

    public function setSite(int $siteId){
        $site = new SiteController();
        $site->getById($siteId);
        $this->site = $site;
    }

    public function setNumero(string $numero){
        if(strlen($numero) > 0 && strlen($numero <= 5))
            $this->numero = $numero; 
    }

    public function setRue(string $rue){
        if(strlen($rue) > 0 && strlen($rue) <= 80)
            $this->rue = $rue;   
    }

    public function setPostcode(string $postcode){
        if(strlen($postcode) == 5)
            $this->postcode = $postcode; 
    }

    public function setArea(string $area){
        if(strlen($area) > 0 && strlen($area) <= 80)
            $this->area = $area; 
    }

    public function setCapacity(int $number){
        if($number > 0)
            $this->capacity;
    }

    public function create(){
        $api = new ApiManager('Depositery');
		if($this->id != null){
			return false;
		}
		$array = array(
			'ID' => NULL,
			'SiteID' => $this->site->getId(),
			'Numero' => $this->numero,
			'Rue' => $this->rue,
			'Postcode' => $this->postcode,
            'Area' => $this->area,
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
		$api = new ApiManager('Depositery');
		$array = array(
			'ID' => $this->id,
			'SiteID' => $this->site->getId(),
			'Numero' => $this->numero,
			'Rue' => $this->rue,
			'Postcode' => $this->postcode,
            'Area' => $this->area,
            'Capacity' => $this->capacity);
		$json = json_encode($array);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('Depositery');
		$array = array(
			'ID' => $this->id,
			'SiteID' => $this->site->getId(),
			'Numero' => $this->numero,
			'Rue' => $this->rue,
			'Postcode' => $this->postcode,
            'Area' => $this->area,
            'Capacity' => $this->capacity);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
}

?>