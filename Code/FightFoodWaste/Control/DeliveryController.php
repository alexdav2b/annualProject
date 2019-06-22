<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Delivery.php';

Class DeliveryController{

    // Parse Json
    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){

            $truckController = new TruckController();
            $truck = $truckController->getById(intval($line['TruckID']));

            $userController = new UserController();
            $user = $userController->getById(intval($line['UsrID']));

            $typeController = new DeliveryTypeController();
            $type = $typeController->getById(intval($line['DeliveryTypeID']));

            $delivery = new Delivery($line['ID'], $truck, $user, $type, $line['DateStart'], $line['DateEnd']);
            array_push($result, $delivery);
        }
        return $result;
    }

    private function parseOne($json) : Delivery{
        $truckController = new TruckController();
        $truck = $truckController->getById(intval($json['TruckID']));

        $userController = new UserController();
        $user = $userController->getById(intval($json['UsrID']));

        $typeController = new DeliveryTypeController();
        $type = $typeController->getById(intval($json['DeliveryTypeID']));

        $delivery = new Delivery($json['ID'], $truck, $user, $type, $json['DateStart'], $json['DateEnd']);
        return $delivery;
    }

    // Get
    public function getById(int $id) : Delivery{
        $api = new ApiManager('Delivery');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Delivery');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByType(int $typeId) : array{
        $api = new ApiManager('Delivery');
        $json = $api->getByInt('DeliveryTypeID', $typeId);        
        return $this->parseAll($json);
    }

    public function getByUser($userId) : array{
        $api = new ApiManager('Delivery');
        $json = $api->getByInt('UsrID', $userId);        
        return $this->parseAll($json);
    }

    public function getByTruck($truckId) : array{
        $api = new ApiManager('Delivery');
        $json = $api->getByInt('Truck', $truckId);        
        return $this->parseAll($json);
    }

    public function getByDateStart($date) : array{
        $api = new ApiManager('Delivery');
        $json = $api->getByString('DateStart', $date);        
        return $this->parseAll($json);
    }

    public function getByDateEnd($date) : array{
        $api = new ApiManager('Delivery');
        $json = $api->getByString('DateEnd', $date); 
        return $this->parseAll($json);
    }

    // Views 

    public function view(int $id){
        $delivery = $this->getById($id);
        require_once __DIR__ . '/../public/View/deliveryGestionView.php';
    }

    public function viewAll(){
        $deliveries = $this->getAll();
        if($deliveries != NULl){
            require_once __DIR__ . '/../public/View/deliveryGestionView.php';
        }
    }

    // public function viewSite(){
    //     $deliveries = ;
    //     if($deliveries != NULl){
    //         require_once __DIR__ . '/../public/View/deliveryGestionView.php';
    //     }
    // }

}

?>