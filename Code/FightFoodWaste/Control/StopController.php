<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Delivery.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Stop.php';

Class StopController{

    // Parse
    private function parseOne($json) : Stop{
        $userController = new UserController();
        $user = $userController->getById(intval($json['UsrID']));
        return new Stop($json['ID'], $json['DateHour'], $json['DeliveryID'], $user);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $deliveryController = new DeliveryController();
            $delivery = $deliveryController->getById(intval($line['DeliveryID']));
            $userController = new UserController();
            $user = $userController->getById(intval($line['UsrID']));
            $stop = new Stop($line['ID'], $line['DateHour'], $line['DeliveryID'], $user);
            array_push($result, $stop);
        }
        return $result;
    }

    // Get
    public function getById(int $id){
        $api = new ApiManager('Stop');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Stop');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByDate($date){
        $api = new ApiManager('Stop');
        $json = $api->getByString('Date', $date);
        return $this->parseAll($json);
    }

    public function getByUser(int $userId){
        $api = new ApiManager('Stop');
        $json = $api->getByInt('UsrID', $userId);
        return $this->parseAll($json);
    }

    public function getByDelivery(int $deliveryId){
        $api = new ApiManager('Stop');
        $json = $api->getByString('DeliveryID', $deliveryId);
        return $this->parseAll($json);
    }

    // Views
}

?>