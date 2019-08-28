<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/StopProduct.php';

Class StopProductController{

    // Parse
    private function parseOne($json) : StopProduct{
        return new StopProduct($json['ID'], $json['StopID'], $json['ProductID']);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $object = new StopProduct($line['ID'], $line['StopID'], $line['ProductID']);
            array_push($result, $object);
        }
        return $result;
    }

    // GET
    public function getAll() : array{
        $api = new ApiManager('stop_product');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getById(int $id){
        $api = new ApiManager('stop_product');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getByStopId(int $id){
        $api = new ApiManager('stop_product');
        $json = $api->getByInt('StopID', $id);
        return $this->parseOne($json);
    }

    public function getByProductId(int $id){
        $api = new ApiManager('stop_product');
        $json = $api->getByInt('ProductID', $id);
        return $this->parseOne($json);
    }
}
?>