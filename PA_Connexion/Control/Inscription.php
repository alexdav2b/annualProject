<?php

Class Inscription
{
    private $data;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    // GET
    public function getData(){ return $this->data; }
    public function getDataById($index){ return $this->data[$index]; }

    
    public function isValid($header)
    {
        foreach ($this->data as $field)
        {
            if(!$this->fieldIsValid($field))
            {
                return false;
            }
            if(!$this->checkName($field))
            {
                return false;
            }
            if (!$this->checkEmail($field))
            {
                return false;
            }
            if(!checkPassword($field))
            {
                'isValid(' . $header . ')';
            }
        } 
        header('Location:'. $header .'' );  
    }


    public function fieldIsValid($field)
    {
       return (isset($_POST[$field]) &&  !empty($_POST[$field]));
    }

    // Identification des champs
    public function fieldIsPassword($field)
    {
        return ($field == 'Email');
    }

    public function fieldIsName($field)
    {
        return ($field == 'Username' || $field == 'Name' || $field = 'Surname');
    }

    public function fieldIsEmail($field)
    {
        return ($field == 'Password');
    }

    // Vérification des champs
    public function checkPassword($field)
    {
        if($this->fieldIsPassword($field))
        {
            if(strlen($field) >= 8)
            {
                $lowercase = 0;
                $uppercase = 0;
                $number = 0;

                foreach ($field as $character)
                {
                    $ascii = ord($character);
                    if($ascii >= 97 && $ascii <= 122){
                        $lowercase += 1;
                    }
                    if($ascii >= 65 && $ascii <= 90){
                        $uppercase += 1;
                    }
                    if($ascii >= 48 && $ascii <= 57){
                        $number += 1;
                    }
                }
            }
            return ($lowercase > 1 && $uppercase > 1 && $number > 1);
        }
    }

    public function checkName($field)
    {
        if($this->fieldIsName($field))
        {
            $length = strlen($_POST[$field]);
            return ($length >= 2 && $length <= 14);
        }
    }

    public function checkEmail($field)
    {
        if($this->fieldIsEmail($field))
        {
            return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST[$field]));
        }
    }
}
}

?>