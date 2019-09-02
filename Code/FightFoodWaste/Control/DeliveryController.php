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

            $delivery = new Delivery($line['ID'], $truck, $user, $type, $line['DateStart'], $line['DateEnd'], $line['Url']);
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

        $delivery = new Delivery($json['ID'], $truck, $user, $type, $json['DateStart'], $json['DateEnd'], $json['Url']);
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


    public function New(){
        $typeC = new DeliveryTypeController();
        $types = $typeC->getAll();
        require_once __DIR__ .  '/../public/View/ItineraireView.php';

    }

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

    // FUNCTIONS ADDITIONNELES
        // 1x Choix type de livraison (ajax)
        // 2x Choix site (ajax)
        // 3x Choix depot (ajax)
        // 4x Choix de la date

        // 4. Bouton générer l'itinéraire = > Distribution des produits/user => Génération des coordonnées
        // 7. Génération de l'itinéraire
        // 8. Validation
        // 9. Données dans BDD

    // 1.
    public function ChoseType($id){
        if($id != 0 && $id != null){
            $deliveryTypeController = new DeliveryTypeController();
            $this->type = $deliveryTypeController->getById($id);
            return true;
        }
        else{
            return false;
        }
    }

    public function PrintSite(){
        $typeId = $_POST['typeId'];
        $bool = $this->ChoseType($typeId);
        if($bool){
            $siteC = new SiteController();
            $sites = $siteC->getAll();
            http_response_code(201);
            echo(json_encode($sites));
        }else{
            http_response_code(400);
        }
    }

    // 2.
    public function ChoseSite($siteId){
        if($siteId != null && $siteId != 0 ){
            $siteController = new SiteController();
            $site = $siteController->getById(intval($siteId));
            return $site != null;
        }
        return false;
    }

    public function PrintDepot(){
        $siteId = $_POST['siteId'];
        $bool = $this->ChoseSite($siteId);
        if($bool){
            $depotC = new DepositeryController();
            $depots = $depotC->getBySite($siteId);

            http_response_code(201);
            echo(json_encode($depots));
        }else{
            http_response_code(400);
        }
    }

    // 3.
    public function ChoseDepot($id){
        if($id != null && $id != 0){
			$depositeryController = new DepositeryController();
            $depot = $depositeryController->getById($id);
            return $depot != null;
        }
        return false;
    }
    public function PrintDate(){
        $depotId = $_POST['depotId'];
        $bool = $this->ChoseDepot($depotId);
        if($bool){
            http_response_code(201);
        }else{
            http_response_code(400);
        }
    }

    // 4.
    public function PrintTrucks(){
        $siteId = $_POST['siteId'];
        if($siteId != null && $siteId != 0){
            $truckController = new TruckController();
            $trucks = $truckController->getBySite($siteId);
            if($trucks != null){
                echo json_encode($trucks);
                http_response_code(201);
            }else{
                http_response_code(400);
            }
        }else{
            http_response_code(400);
        }
    }
    public function PrintMap(){
        $siteId = intval($_POST['siteId']);
        $typeId = intval($_POST['typeId']);
        $dateStart = new DateTime($_POST['dateStart']);
        $depotId = intval($_POST['depotId']);

        if($depotId != null && $depotId != 0 && 
           $siteId != null && $siteId != 0 &&
           $typeId != null && $typeId != 0 &&
           $dateStart != null)
        {
            $livraison = new Delivery(null, null, null, null, $dateStart, null, null);
            $livraison->setDepot($depotId);
            $livraison->setSite($siteId);
            $livraison->setType($typeId);

            $stops = $livraison->SearchStops();
            if($stops != null){
                // $arrayJSON = $livraison->GetCoordinates($stops);
                $start = "";
                $end = "";
                $depotAdd = $livraison->getDepot()->getNumero() . ' ' . $livraison->getDepot()->getRue() . ' ' . $livraison->getDepot()->getPostcode() . ' ' . $livraison->getDepot()->getArea();
                $siteAdd = $livraison->getSite()->getNumero() . ' ' . $livraison->getSite()->getRue() . ' ' . $livraison->getSite()->getPostcode() . ' ' . $livraison->getSite()->getArea();
                if($typeId == 1){
                    // collection
                    $start = $siteAdd;
                    $end = $depotAdd;
                }else if($typeId == 2){
                    $start = $depotAdd;
                    $end = $siteAdd;

                }
                $url = $livraison->GenerateItinerary($stops, $start, $end, $dateStart);

                $startUrl = 'https://maps.googleapis.com/maps/api/directions/json?origin=';
                $endUrl = '&dirflg=r&timeType=Departure&dateTime='. urlencode($dateStart->format("Y-m-d H:i:s")) .'&key='. GOOGLE;
                
                $link = $startUrl . $url . $endUrl;
                $datas = file_get_contents($link);
                $datas = json_decode($datas);
                $json = array(
                    "url" => $url,
                    "stops" => $stops,
                    "map" => $datas
                );
                echo json_encode($json);
                http_response_code(201);
            }else{
                http_response_code(400);
            }
        }else{
            http_response_code(400);
        }
    }


    //5.

    public function ChoseTruck($id){
        if($id != null && $id != 0){
            $truckController = new TruckController();
            $truck = $truckController->getById(intval($id));
            return $truck != null;
        }
        return false;
    }

    public function PrintEmployees(){
        $siteId = $_POST['siteId'];
        $truckId = $_POST['truckId'];
        $bool = $this->ChoseTruck($truckId);
        if($bool){

            $empC = new EmployeeController();
            $emps = $empC->getBySite(intval($siteId));
            $users = array();
        
            foreach($emps as $user){
                array_push($users, array("id" => $user->getId(),  "name" => $user->getName() ,"surname" =>  $user->getSurname()));
            }
            http_response_code(201);
            echo json_encode($users);
        }else{
            http_response_code(400);
        }
    }


    public function map($adresse){
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $adresse ."&dirflg=r&timeType=Departure&dateTime=2019-09-10+12%3A34%3A00&key=AIzaSyCh044HyiYN4VW133avwoTnSqdJKfgGM8M";
        require_once __DIR__ . '/../public/View/mapView.php';
    }


    // 4.



    public function ChoseEmploye(){
        $userID = $_POST['id'];
        if($userId != null && $userId != 0){
            $employeeC = new EmployeeController();
            $employee = $employeeC->getById(intval($userId));
            $user = array("id" => $employee->getId(),  "name" => $employee->getName() ,"surname" =>  $employee->getSurname());

            http_response_code(201);
            echo json_encode($user);
        }
        http_response_code(400);

    }




}

?>