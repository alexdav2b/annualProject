<?php

Class Justificatif implements JsonSerializable{
    // Properties
    private $id;
    private $link; // varchar 255 & NULLABLE
    private $userId;
    private $competenceId;

    // Constructor
    public function __construct(?int $id, ?string $link, int $userId, string $competenceId){
        $this->id = $id;
        $this->setLink($link);
        $this->userId = $userId;
        $this->competenceId = $competenceId;
    }

    // Getter
    public function getId(): ?int { return $this->id; }
    public function getLink(): ?string { return $this->link; }
    public function getUserId(): int { return $this->userId; }
    public function getCompetenceId() : int { return $this->competenceId; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    
    public function setLink(?string $link){ 
        if($link != null && $this->StringIsNotOver($link, 255))
            $this->link = $link;
    }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }

    private function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
    }
}
?>