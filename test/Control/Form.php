<?php

Class Form{
    // Proprieties
    private $data;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    // GET
    public function getData(){ return $this->data; }
    public function getDataById($index){ return $this->data[$index]; }

    // METHODS : FORM GENERATION
    // --------------------------

    // Génère une balise input
    public function input($name)
    {
        $input = '<input class = "form-control" type = "text" name = "' . $name . '" id = "' . $name . '" placeholder = "' . $name . '">';
        return $input;     
    }

    // Génère une balise button de type submit
    public function submit($text)
    {
        $id = 'On' . $text;
        $button = '<p><button class = "btn btn-success" id = "' . $id . '" type = "submit" value = "' . $text . '"> ' . $text .'</button></p>';
        return $button;
    }

    // Génère toutes les balises inputs du formulaire
    public function echoAllInputs()
    {
        foreach ($this->data as $field)
        {
            echo $this->input($field);
        }
    }

    // Génère toutes les balises input et submit du formulaire
    public function echoAllForm($submitText)
    {
        $this->echoAllInputs();
        echo $this->submit($submitText);
    }
}

function OnConnexion(){
    // onclick = 'OnConnexion'
    // $verif = new Connexion()
    // $verif = $this->
}
?>