<?php

Class Tournee{

    private $truck;
    private $employe;
    private $site;
    private $type;
    private $depot;

    // private $products;
    // private $users;


    // private $dateStart;
    // private $dateEnd;
    // private $coordinates;

    public function __construct(){

    }

    public function getTruck() : ?Truck{ return $this->truck; }
    public function getEmploye() : ?Employee { return $this->employe; }
    public function getSite() : ?Site{ return $this->site; }
    public function getType() : ?Site { return $this->type; }
    public function getDepot() : ?Depositery { return $this->depot; }

    public function setTruck(?Truck $truck){ $this->truck = $truck; }
    public function setEmploye(?Employe $employe){ $this->employe = $employe; }
    public function setSite(?Site $site) { $this->site = $site; }
    public function setType(?DeliveryType $type){ $this->type = $type; }
    public function setDepot(?Depositery $depot) { $this->depot = $depot; }
    
    public function ChoseSite($siteId){
        if($siteId != null && $siteId != 0 ){
            $siteController = new SiteController();
            $this->site = $siteController->getById(intval($siteId));
            return true;
        }
        return false;
    }

    public function ChoseEmploye(int $userId){
        if($userId != null && $userId != 0){
            $employeC = new EmployeeController();
            $this->employe = $employeeC->getById(intval($userId));
            return true;    
        }
        return false;
    }

    public function ChoseType(int $id){
        if($id != 0 && type != null){
            $deliveryTypeController = new DeliveryTypeController();
            $this->type = $deliveryTypeController->getById($deliveryTypeId);
            return true;
        }
        else{
            return false;
        }
    }

    public function ChoseDepot(int $id){
        if($id != null && $id != 0){
            $depositeryController = new DepositeryController();
            $this->depot = $depositeryController->getBySite($site->getId());
            return true;
        } 
        return false;
    }

    public function ChoseTruck(int $id){
        if($truckId != null && $truckId != 0){
            $truckController = new TruckController();
            $this->truck = $truckController->getById(intval($truckId));
            return true;
        }
        return false;
    }
}


?>