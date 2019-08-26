<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Depositery.php';
require_once __DIR__ . '/../Model/Site.php';

Class DepositeryController{

    // Parse
    private function parseOne($json) : Depositery{
        $siteController = new SiteController();
        $site = $siteController->getById(intval($json['SiteID']));
        return new Depositery($json['ID'], $site, $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Capacity']);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $siteController = new SiteController();
            $site = $siteController->getById(intval($line['SiteID']));
            $depositery = new Depositery($line['ID'], $site, $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Capacity']);
            array_push($result, $depositery);
        }
        return $result;
    }

    // Get
    public function getById(int $id){
        $api = new ApiManager('Depositery');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Depositery');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getBySite(int $siteId) : array{
        $api = new ApiManager('Depositery');
        $json = $api->getByInt('SiteID', $siteId);
        return $this->parseAll($json);
    }

    public function getByNumero(string $numero){
        $api = new ApiManager('Depositery');
        $json = $api->getByString('Numero', $numero);
        return $this->parseAll($json);
    }

    public function getByRue(string $rue){
        $api = new ApiManager('Depositery');
        $json = $api->getByString('Rue', $rue);
        return $this->parseAll($json);
    }

    public function getByPostcode(string $postcode){
        $api = new ApiManager('Depositery');
        $json = $api->getByString('Postcode', $postcode);
        return $this->parseAll($json);
    }

    public function getByArea(string $area){
        $api = new ApiManager('Depositery');
        $json = $api->getByString('Area', $area);
        return $this->parseAll($json);
    }

    public function getByCapacity(int $capacity){
        $api = new ApiManager('Depositery');
        $json = $api->getByInt('Capacity', $capacity);
        return $this->parseAll($json);
    }

    
    // Views
}

?>