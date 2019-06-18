<?php

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Depositery.php';
require_once __DIR__ . '/../Model/Statut.php';

Class Product{
    private $id;
    private $name;
    private $barcode;
    private $validDate;
    private $depositery;
    private $donator;
    private $receiver;
    private $statut;

    public function __construct(?int $id, string $name, string $barcode, $validDate, Depositery $depositery, User $donator, ?User $receiver, Statut $statut){
        $this->id = $id;
        $this->name = $name;
        $this->barcode = $barcode;
        $this->validDate = $validDate;
        $this->depositery = $depositery;
        $this->donator = $donator;
        $this->receiver = $receiver;
        $this->statut = $statut;
    }

    public function getId(): ?int{ return $this->id; }
    public function getName(): string{ return $this->name; }
    public function getBarcode(): string { return $this->barcode; }
    public function getValidDate() { return $this->date; }
    public function getDepositery() : Depositery { return $this->depositery; }
    public function getDonator(): User { return $this->donator; }
    public function getReceiver(): ?User {return $this->receiver; }
    public function getStatut(): Statut { return $this->statut; }

    public function setId(int $id){
        if($id > 0)
            $this->id = $id;
    }

    public function setName(string $name){
        if(strlen($name) > 0 && strlen($name) <= 80)
            $this->name = $name;
    }

    public function setBarcode(string $barcode){
        if(strlen($barcode) > 0 && strlen($barcode) <= 13)
            $this->barcode = $barcode;
    }

    public function setValidDate($date){
        $this->validDate = $date;
    }

    public function setDepositery(int $depositeryId){
        $controller = new DepositeryController();
        $depositery = $controller->getById($depositeryId);
        $this->depositery = $depositery;
    }

    public function setDonator(int $userId){
		$controller = new UserController();
		$donator = $controller->getById($userId);
		$this->donator = $donator;
    }
    
    public function setReceiver(int $userId){
		$controller = new UserController();
		$receiver = $controller->getById($userId);
		$this->receiver = $receiver;
    }
    
    public function setStatut(int $statutId){
        $controller = new StatutController();
		$statut = $controller->getById($statutId);
		$this->statut = $statut;
    }

    public function create(int $idStop){
        $api = new ApiManager('Product');
		if($this->id != null){
			return false;
		}
		$array = array(
            'Name' => $this->name,
            'Barcode' => $this->barcode,
            'ValidDate' => $this->validDate,
            'DepositeryID' => $this->depositery->getId(),
            'UsrID_Donated' => $this->donator->getId(),
            'UsrID_Received' => $this->receiver->getId(),
            'StatutID' => $this->statut->getId());
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
            $this->id = $json['ID'];

            $api = new ApiManager('Stop_Product');
            $array = array(
                'StopID' => $idStop,
                'ProductID' => $this->id);
            $json = json_encode($array);
            $json = $api->create($json);
            if($json != NULL){
                return true;
            }
		}
		return false;
    }

	public function delete(): bool{
		$api = new ApiManager('Stop');
		$json = $api->delete($this->id);
		return $json['Success'];
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('Stop');
		$array = array(
			'ID' => $this->id,
            'Name' => $this->name,
            'Barcode' => $this->barcode,
            'ValidDate' => $this->validDate,
            'DepositeryID' => $this->depositery->getId(),
            'UsrID_Donated' => $this->donator->getId(),
            'UsrID_Received' => $this->receiver->getId(),
            'StatutID' => $this->statut->getId());
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
}

?>