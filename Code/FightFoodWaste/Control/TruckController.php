<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Truck.php';

Class TruckController{

    // Parse
    private function parseOne($json) : Truck{
        $controller = new SiteController();
        $site = $controller->getById(intval($line['SiteID']));
        $truck = new Truck($json['ID'], $json['Plate'], $json['Name'], $json['Capacity'], $site);
        return $truck;
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $controller = new SiteController();
            $site = $controller->getById(intval($line['SiteID']));
            $object = new Truck($line['ID'], $line['Plate'], $line['Name'], $line['Capacity'], $site);
            array_push($result, $object);
        }
        return $result;
    }

    // GET
    public function getById(int $id){
        $api = new ApiManager('Truck');
        $line = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Truck');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getBySite(int $siteId){
        $api = new ApiManager('Truck');
        $json = $api->getByInt('SiteID', $siteId);
        return $this->parseAll($json);
    }

    public function getByPlate(string $plate){
        $api = new ApiManager('Truck');
        $json = $api->getByString('Plate', $plate);
        return $this->parseAll($json);
    }

    public function getByName(string $name){
        $api = new ApiManager('Truck');
        $json = $api->getByString('Name', $name);
        return $this->parseAll($json);
    }

    public function getCapacity(int $number){
        $api = new ApiManager('Truck');
        $json = $api->getByInt('Capacity', $number);
        return $this->parseAll($json); 
    }

    // Views
    public function view(int $id){
        $object = $this->getById($id);
        if($object != NULL){
            require_once __DIR__ . '/../public/View/truckGestionView.php';
        }else{
            header('Location: /404');
        }
    }

    public function viewBySite(int $idSite){
        $objects = $this->getBySite($idSite);
        if($objects != NULl){ 
            require_once __DIR__ . '/../public/View/truckGestionView.php';
        }else{
            header('Location: /404');
        }
    }

    public function viewAll(){
        $objects = $this->getAll();
        if($objects != NULl){
            require_once __DIR__ . '/../public/View/truckGestionView.php';
        }else{
            header('Location: /404');
        }
    }

}