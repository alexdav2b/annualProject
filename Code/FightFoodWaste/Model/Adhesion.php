<?php

require_once __DIR__ . '/../Model/User.php';

 Class Adhesion{
    private $id;
    private $date;
    private $user;

    public function __construct(?int $id, $date, User $user){
        $this->id = $id;
        $this->date = $date;
        $this->user = $user;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDate() { return $this->date; }
    public function getUser(): User { return $this->user; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setDate($date){ $this->date = $date; }

    public function setUser(User $userId){
        $controller = new UserController();
        $user = $controller->getById($userId);
        $this->user = $user;
    }
    
    // Database

    public function create() : bool{
		$api = new ApiManager('Adhesion');
		if($this->id != null){
			return false;
		}
		$array = array(
			'UserID' => $this->user->getId(),
			'DateAdhesion' => $this->date);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Adhesion');
		$json = $api->delete($this->id);
		return $json['Success'];
	}
	public function update(string $discriminator): bool{
        $api = new ApiManager('Adhesion');
        $array = array(
			'ID' => $this->id,
			'UserID' => $this->user->getId(),
			'DateAdhesion' => $this->date);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
 }

 ?>