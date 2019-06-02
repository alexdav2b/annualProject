<?php

Class User implements JsonSerializable{
    // Properties
    private $id; 
    private $siteId;
    private $serviceId;
    private $email; // varchar // nullable ?????
    private $name, //
    private $surname; //
    private $password; // hash // nullable ???
    private $address; // 
    private $postcode; // char 5
    private $area; // 
    private $eligibility; // bool
    private $companyName; // 
    private $siret;
    private $salary; // int -> float
    private $discriminator; // bool

    // Constructor
    public function __construct(?int $id, int $siteId, ?int $serviceId, ?string $email,
    ?string $name, ?string $surname, ?string $password, ?string $address, ?string $postcode,
    ?string $area, bool $eligibility, ?string $companyName, ?int $siret,
    ?int $salary, string $discriminator){
        $this->id = $id;
        $this->siteId = $siteId; // OBLIGATOIRE
        $this->serviceId = $serviceId;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->address = $address; 
        $this->postcode = $postcode;
        $this->area = $area;
        $this->eligibility = $eligibility; // OBLIGATOIRE
        $this->companyName = $companyName;
        $this->siret = $siret;
        $this->salary = $salary;
        $this->discriminator = $discriminator; // OBLIGATOIRE
    }

    // Getter
    public function getId(): ?int{ return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getServiceId(): ?int { return $this->serviceId; }
    public function getEmail(): ?string { return $this->email; }
    public function getName(): ?string { return $this->name; }
    public function getSurname(): ?string { return $this->surname; }
    public function getPassword(): ?string { return $this->password; }
    public function getAddress(): ?string { return $this->address; }
    public function getPostCode(): ?string { return $this->postcode; }
    public function getArea(): ?string { return $this->area; }
    public function getEligibility(): bool { return $this->eligibility; }
    public function getCompanyName(): ?string { return $this->CompanyName; }
    public function getSiret(): ?int { return $this->siret; }
    public function getSalary(): ?int { return $this->salary; }
    public function getDiscriminator(): string { return $this->discriminator; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    public function setSiteId(int $id){ $this->siteId = $id; }
    public function setServiceId(int $id){ $this->siteId = $id; }
    public function setEmail(string $email){ $this->email = $email; }
    public function setName(string $name){ $this->name = $name; }
    public function setSurname(string $surname){ $this->surname = $surname; }
    public function setPassword(string $password){ $this->password = $password; }
    public function setAddress(string $address){ $this->address = $address; }
    public function setPostcode(string $postcode){ $this->postcode = $postcode; }
    public function setArea(string $area){ $this->area = $area; }
    public function setEligibility(bool $bool){ $this->eligibility = $eligibility; }
    public function setCompanyName(string $name){ $this->companyName = $name; }
    public function setSiret(int $siret){ $this->siret = $siret; }
    public function setSalary(int $salary){ $this->salary = $salary; }
    public function setDiscriminator(string $name){ $this->discriminator = $anme; }


    // Method
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>