<?php

Class Statut{
    private $id;
    private $name;

    public function __construct(?int $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int{ return $this->id; }
    public function getName(): string{ return $this->name; }

    public function setId(int $id){
        if($id > 0)
            $this->id = $id;
    }

    public function setName(string $name){
        if(strlen($name) > 0 && strlen($name) <= 80)
            $this->name = $name;
    }

    public function create(){
        $api = new ApiManager('Statut');
		if($this->id != null){
			return false;
		}
		$array = array(
			'ID' => NULL,
			'Name' => $this->name);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['Statut'];
			return true;
		}
		return false;
    }

	public function delete(): bool{
		$api = new ApiManager('Statut');
        $array = array(
			'ID' => $this->id,
			'Name' => $this->name);
		$json = json_encode($array);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('Statut');
        $array = array(
			'ID' => $this->id,
			'Name' => $this->name);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
}

?>