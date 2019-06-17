<?php

Class Site{

    private $id;
    private $name;
    private $numero;
    private $rue;
    private $postcode;
    private $area;
    private $capacity;


    public function __construct(?int $id, string $name, string $numero, string $rue, string $postcode, string $area, int $capacity){
        $this->id = $id;
        $this->name = $name; 
        $this->numero = $numero; 
        $this->rue = $rue;
        $this->postcode = $postcode;
        $this->area = $area;
        $this->capacity = $capacity;
    }

    public function getId(): ?int{ return $this->id; }
    public function getName(): string { return $this->name; }
    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostcode() : string { return $this->postcode; }
    public function getArea() : string { return $this->area; }
    public function getCapacity() : int { return $this->capacity; }


    public function setId(int $id){ 
        if($id > 0)
            $this->id = $id; 
    }

    public function setName(string $name){
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }
        
    public function setNumero(string $numero){
        if($this->StringIsNotOver($numero, 5))
            $this->numero = $numero; 
    }

    public function setRue(string $rue){
        if($this->StringIsNotOver($rue, 80))
            $this->rue = $rue;   
    }

    public function setPostcode(string $postcode){
        if($this->StringIsNotOver($postcode, 80))
            $this->postcode = $postcode; 
    }

    public function setArea(string $area){
        if($this->StringIsNotOver($area, 80))
            $this->area = $area; 
    }

    public function setCapacity(int $number){
        if($number > 0)
            $this->capacity;
    }

    // Method

    private function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
    }

    public function create(string $discriminator) : bool{
		$api = new ApiManager('Site');
		if($this->id != null){
			return false;
		}
		$array = array(
			'Name' => $this->name,
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
		$api = new ApiManager('Site');
		$array = array(
			'ID' => $this->id,
			'Name' => $this->name,
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
		$api = new ApiManager('Site');
		$array = array(
			'ID' => $this->id,
			'Name' => $this->name,
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