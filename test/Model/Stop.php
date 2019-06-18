<?php

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Delivery.php';


Class Stop{
    private $id;
    private $dateHour;
    private $delivery;
    private $user;

    public function __construct(int $id, $date, Delivery $delivery,User $user){

    }

    public function create(){}

    public function update(){}
}

?>