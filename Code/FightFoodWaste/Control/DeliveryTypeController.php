<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/DeliveryType.php';

Class DeliveryTypeController{

    private function parseOne($json) : DeliveryType{
        return new DeliveryType($json['ID'], $json['Name']);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $object = new DeliveryType($line['ID'], $line['Name']);
            array_push($result, $object);
        }
        return $result;
    }

    public function getById(int $id) : DeliveryType{
        $api = new ApiManager('DeliveryType');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('DeliveryType');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByName(string $name) : array{
        $api = new ApiManager('DeliveryType');
        $json = $api->getByString('Name', $name);
        return $this->parseAll($json);
    }

    // public function viewAll(){
    //     $DeliveryTypes = $this->getAll();
    //     if($DeliveryTypes != NULL){
    //         require_once __DIR__ . '/../public/View/DeliveryTypeGestionView.php';
    //     }
    // }

    // public function view(int $id){
    //     $DeliveryType = $this->getById($id);
    //     if($DeliveryType != NULL){
    //         require_once __DIR__ . '/../public/View/DeliveryTypeGestionView.php';
    //     }
    // }
}

?>