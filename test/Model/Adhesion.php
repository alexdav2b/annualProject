<?php

require_once __DIR__ . '/../Model/User.php';

 Class Adhesion{
    private $id;
    private $date;
    private $cb;
    private $code;
    private $user;

    public function __construct(?int $id, $date, string $cb, string $code, User $user){
        $this->id = $id;
        $this->date = $date;
        if(strlen($cb) == 16)
            $this->cb = $cb; 
        if(strlen($code) == 16)
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
        $user = new UserManager();
        $user->getById($userId);
        $this->user = $user;
    }
    
    // Database

    public function create() : bool{
		$api = new ApiManager('Adhesion');
		if($this->id != null){
			return false;
		}
		$json = array(
			'ID' => NULL,
			'UserID' => $this->user->getId(),
			'DateAdhesion' => $this->date,
			'Cb' => $this->cb,
			'Code' => $this->$code);
		$json = json_encode($this);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Adhesion');
		$json = json_encode($this);
		$json = $api->delete($json);
		if ($json != NULL){
			return true;
		}
		return false;
	}
	public function update(string $discriminator): bool{
        $api = new ApiManager('Adhesion');
        $json = array(
			'ID' => $this->id,
			'UserID' => $this->user->getId(),
			'DateAdhesion' => $this->date,
			'Cb' => $this->cb,
			'Code' => $this->$code);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}
 }