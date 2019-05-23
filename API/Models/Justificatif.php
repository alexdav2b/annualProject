<?php

Class Justificatif implements JsonSerializable{
    // Properties
    private $id;
    private $link; // varchar
    private $userId;
    private $competenceId;

    // Constructor
    public function __construct(?int $id, string $link, int $userId, string $competenceId){
        $this->id = $id;
        $this->link = $link;
        $this->userId = $userId;
        $this->competenceId = $competenceId;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getLink(): int { return $this->link; }
    public function getUserId(): int { return $this->userId; }
    public function getCompetenceId() : int { return $this->competenceId; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setLink(string $link){ $this->link = $link; }
    public function setUserId(int $id){ $this->userId = $id; }
    public function setCompetenceId(int $id){ $this->competenceId = $id; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>