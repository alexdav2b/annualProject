<?php
Class Connexion
{
    // Properties
    private $email;
    private $password;

    // Contruct
    public function __construct()
    {
        $this->email = $_POST['Email'];
        $this->password = $_POST['Password'];
    }

    // GET
    public function getEmail(){ return $this->email; }
    public function getPassword(){ return $this->password; }

    // VERIFICATION
    public function isValid(){
        if($this->fieldIsValid($this->getEmail()) && $this->fieldIsValid($this->getPassword()))
        {
            // interractions bdd
        }
    }

    private function fieldIsValid($field)
    {
       return (isset($field) &&  !empty($field));
    }       
}

$connexion = new Connexion();
echo $connexion->getEmail();
echo $connexion->getPassword();

?>