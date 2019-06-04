<?php

Class User implements JsonSerializable{
    // Properties
    private $id; 
    private $siteId;
    private $email; // VARCHAR 255
    private $name; // VARCHAR 80
    private $password; // VARCHAR 200
    private $eligibility; // bool

    private $numero; // VARCHAR 5
    private $rue; // VARCHAR 80
    private $postcode; // char 5
    private $area; // VARCHAR 80

    private $discriminator; // varchar 10

    private $surname; // VARCHAR 80 & nullable
    private $serviceId; // nullable
    private $siret; // nullable & 14 VARCHAR
    private $salary; // float & nullable

    // Constructor
    public function __construct(?int $id, int $siteId, ?int $serviceId, string $email,
    string $name, ?string $surname, string $password, string $numero, string $rue, string $postcode,
    string $area, int $eligibility,  ?string $siret, ?float $salary, string $discriminator){
        $this->id = $id;
        $this->siteId = $siteId; 
        $this->serviceId = $serviceId;
        $this->setEmail($email);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setPassword($password);
        $this->setNumero($numero);
        $this->setRue($rue);
        $this->setPostcode($postcode);
        $this->setArea($area);
        $this->eligibility = $eligibility; 
        $this->setSiret($siret);
        $this->setSalary($salary);
        $this->setDiscriminator($discriminator);
    }

    // Getter
    public function getId(): ?int{ return $this->id; }
    public function getSiteId(): int { return $this->siteId; }
    public function getServiceId(): ?int { return $this->serviceId; }
    public function getEmail(): string { return $this->email; }
    public function getName(): string { return $this->name; }
    public function getSurname(): ?string { return $this->surname; }
    public function getPassword(): string { return $this->password; }

    public function getNumero(): string { return $this->numero; }
    public function getRue(): string { return $this->rue; }
    public function getPostCode(): string { return $this->postcode; }
    public function getArea(): string { return $this->area; }

    public function getEligibility(): int { return $this->eligibility; }
    public function getSiret(): ?string { return $this->siret; }
    public function getSalary(): ?float { return $this->salary; }

    public function getDiscriminator(): string { return $this->discriminator; }

    // Setter
    public function setId(int $id){ $this->id = $id; }
    
    public function setSiret(?string $siret){
        if(strlen($siret) == 14)
            $this->siret = $siret;
    }
    
    public function setSalary(?float $salary){ 
        if($salary > 0)
            $this->salary = $salary; 
    }

    public function setDiscriminator(string $name){ 
        if($name == "EMPLOYEE" || 
           $name == "USER" || 
           $name == "COMPANY" || 
           $name == "MEMBER" || 
           $name == "MEMBER")
            $this->discriminator = $name; 
    }

    public function setEmail(string $email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $this->email = $email; 
    }

    public function setName(string $name){ 
        if($this->StringIsNotOver($name, 80))
            $this->name = $name; 
    }

    public function setSurname(?string $surname){
        if($this->StringIsNotOver($surname, 80))
            $this->surname = $surname; 
    }

    public function setPassword(string $password){
        if($this->StringIsNotOver($password, 20)){
            $salt = bin2hex(random_bytes(5)); // 10 characters
            $this->password = $this->HashNSalt($salt,  $password); // 50 characters
        
        }
    }

    public function setNumero(string $numero){
        if($this->StringIsNotOver($numero, 5))
            $this->numero = $numero;
    }

    public function setRue(string $rue){
        if($this->StringIsNotOver($rue, 80))
            $this->rue = $rue;
    }

    public function setPostcode(string $postcode){ 
        if(strlen($postcode) == 5)
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
        $salted = $salt . $password; 
        $algo = 'ripemd160'; 
        $hashed = hash($algo, $salted, FALSE);
        $password = $hashed . $salt; 
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