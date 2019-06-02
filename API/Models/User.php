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
    private $postcode; // char 5
    private $area; // 
    private $eligibility; // bool
    private $companyName; // 
    private $siret;
    private $salary; // int -> float
    private $discriminator; // bool

    // Constructor
    public function __construct(?int $id, int $siteId, ?int $serviceId, ?string $email,
    ?string $name, ?string $surname, ?string $password, ?string $postcode,
    ?string $area, bool $eligibility, ?string $companyName, ?int $siret,
    ?int $salary, string $discriminator){
        $this->id = $id;
        $this->siteId = $siteId; // OBLIGATOIRE
        $this->serviceId = $serviceId;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
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
    public function getPassword(): ?string { return $this->password;}
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
    // public function setEmail(string $email){ $this->email = $email; }
    // public function setName(string $name){ $this->name = $name; }
    // public function setSurname(string $surname){ $this->surname = $surname; }
    // public function setPassword(string $password){ $this->password = $password; }
    // public function setPostcode(string $postcode){ $this->postcode = $postcode; }
    // public function setArea(string $area){ $this->area = $area; }
    public function setEligibility(bool $bool){ $this->eligibility = $eligibility; }
    
    // FONCTIONS A RAJOUTER
    // public function setCompanyName(string $name){ $this->companyName = $name; }
    // public function setSiret(int $siret){ $this->siret = $siret; }
    // public function setSalary(int $salary){ $this->salary = $salary; }
    public function setDiscriminator(string $name){ $this->discriminator = $name; }

    public function setEmail(string $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $this->email = $email; 
    }

    public function setName(string $name){ 
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }

    public function setSurname(string $surname){
        if($this->StringIsNotOver($surname, 80))
            $this->surname = $surname; 
    }

    public function setPassword(string $password){
        if($this->StringIsNotOver($password, 20))
            $salt = bin2hex(random_bytes(5)); // 10 characters
            $this->password = HashNSalt(string $salt, string $password) // 50 characters
    }

    public function setPostcode(string $postcode){ 
        if(strlen($postcode == 5))
            $this->postcode = $postcode; 
    }

    public function setArea(string $area){
        if($this->StringIsNotOver($area, 80))
            $this->area = $area;
    }

    // Methods

    private function HashNSalt(string $salt, string $password): string{
        // in DATABASE :  10st characters = SALT, 40 last = hash (SALT + PASSWORD)
        // ripemd160 => 40 characters
        $salted = $salt + $password; 
        $algo = 'ripemd160'; 
        $hashed = hash($algo, $salted, FALSE);
        $password = $hashed + $salt; 
        return $password;
    }

    public function Connexion(){
        session_start();
        session_regenerate_id();
        if (!isset($_SESSION['userId'])) {
            $_SESSION['userId'] = 0;
        } else {
            $_SESSION['userId']++;
        }
    }

    public function Deconnnexion(){
        session_start();
        session_destroy ();
    }

    protected function StringIsNotOver(string $str, int $length){
        return (strlen($str) > 0 && strlen($str) <= $length);
    }

    public function PasswordIsValid(string $password, string $hashedPassword): bool{
        $salt = substr($hashedPassword, 0, 10);
        $password = HashNSalt($password, $salt);
        return ($password == $hashedPassword);
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

?>