<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Depositery.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Statut.php';

Class ProductController{

    // Parse
    private function parseOne($json) : Product{
        $depositeryController = new DepositeryController();
        $depositery = $depositeryController->getById(intval($json['DepositeryID']));

        $userController = new UserController();
        $receiver = $receiverController->getById(intval($json['UsrID_Received']));
        $donator = $userController->getByInt(intval($json['UsrID_Donated']));

        $statutController = new StatutController();
        $statut = $statutController->getById(intval($json['StatutID']));

        return new Product($json['ID'], $json['Name'], $json['Barcode'], $json['ValidDate'], $depositery, $donator, $receiver, $staut);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $depositeryController = new DepositeryController();
            $depositery = $depositeryController->getById(intval($json['DepositeryID']));
    
            $userController = new UserController();
            $receiver = $receiverController->getById(intval($json['UsrID_Received']));
            $donator = $userController->getByInt(intval($json['UsrID_Donated']));
    
            $statutController = new StatutController();
            $statut = $statutController->getById(intval($json['StatutID']));
    
            $product = new Product($line['ID'], $line['Name'], $line['Barcode'], $line['ValidDate'], $depositery, $donator, $receiver, $staut);
    
            array_push($result, $product);
        }
        return $result;
    }

    // Get
    public function getById(int $id){
        $api = new ApiManager('Product');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Product');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByName(string $name){
        $api = new ApiManager('Product');
        $json = $api->getByString('Name', $name);
        return $this->parseAll($json);
    }

    public function getByBarcode(string $barcode){
        $api = new ApiManager('Product');
        $json = $api->getByString('Barcode', $barcode);
        return $this->parseAll($json);
    }

    public function getByValidDate($date){
        $api = new ApiManager('Product');
        $json = $api->getByString('ValidDate', $date);
        return $this->parseAll($json);
    }

    public function getByDepositery(int $depositeryId){
        $api = new ApiManager('Product');
        $json = $api->getByInt('DepositeryID', $depositeryId);
        return $this->parseAll($json);
    }
     
    public function getByDonator(int $userId){
        $api = new ApiManager('Product');
        $json = $api->getByInt('UsrID_Donated', $userId);
        return $this->parseAll($json);
    }

    public function getByReceiver(int $userId){
        $api = new ApiManager('Product');
        $json = $api->getByInt('UsrID_Received', $userId);
        return $this->parseAll($json);
    }

    public function getByStatut(int $statutId){
        $api = new ApiManager('Product');
        $json = $api->getByInt('StatutID', $statutId);
        return $this->parseAll($json);
    }

    // Views
}

?>