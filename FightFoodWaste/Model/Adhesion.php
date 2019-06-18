<?php

require_once __DIR__ . '/../Model/User.php';

 Class Adhesion{
    private $id;
    private $date;
    private $cb;
    private $code;
    private $user;

    public function __construct(?int $id, $date, string $cb, string $code, User $user){
        if(strlen($cb) != 16 && strlen($code) != 16){
            throw new Exception();
        }
        $this->id = $id;
        $this->date = $date;
        $this->cb = $cb; 
        $this->code = $code;
        $this->user = $user;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getDate() { return $this->date; }
    public function getCB(): string { return $this->cb; }
    public function getCode(): int { return $this->code; }
    public function getUser(): User { return $this->user; }

    // Setter
    public function setId(int $id){ $this->id = $id; }

    public function setDate($date){ $this->date = $date; }

    public function setCB(string $cb){ 
        if(strlen($cb) == 16)
            $this->cb = $cb; 
    }

    public function setCode(string $code){ 
        if(strlen($code) == 16)
            $this->code = $code; 
    }

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
			'DateAdhesion' => $this->date,
			'Cb' => $this->cb,
			'Code' => $this->$code);
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
			'DateAdhesion' => $this->date,
			'Cb' => $this->cb,
			'Code' => $this->$code);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
 }