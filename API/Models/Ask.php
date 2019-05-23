<?php

Class Ask implements JsonSerializable{
    // Properties
    private $id;
    private $userMakeId;
    private $userAnswerId;
    private $askTypeId;
    private $subject;
    private $dateStart; // date
    private $dateEnd; // date

    // Constructor
    public function __construct(?int $id, int $userMakeId, int $userAnswerId, int $askTypeId, string $subject, date $dateStart, date $dateEnd){
        $this->id = $id;
        $this->userMakeId = $userMakeId;
        $this->userAnswerId = $userAnswerId;
        $this->askTypeId = $askTypeId;
        $this->subject = $subject;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    // Getter
    public function getId(): ?int{ return $this->id; }
    public function getUserMakeId(): int { return $this->userMakeId; }
    public function getUserAnswerId(): int { return $this->userAnswerId; }
    public function getAskTypeId(): int { return $this->askTypeId; }
    public function getSubject(): string { return $this->subject; }
    public function getDateStart(): date { return $this->dateStart; }
    public function getDateEnd(): date { return $this->dateEnd; }

    // Setter
    public function setId(int $id) { $this->id = $id; }
    public function setUserMakeId(int $id){ $this->userMakeId = $id; }
    public function setUserAnswerId(int $id) { $this->userAnswerId = $id; }
    public function setAskTypeId(int $id){ $this->askTypeId = $id; }
    public function setSubject(string $subject){ $this->subject = $subject; }
    public function setDateStart(date $date){ $this->dateStart = $date; }
    public function setDateEnd(date $date){ $this->dateEnd = $date; }

    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>