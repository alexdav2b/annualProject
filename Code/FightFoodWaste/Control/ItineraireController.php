<?php

require_once __DIR__ . '/../Model/Adresse.php';
require_once __DIR__ . '/../Model/Vehicule.php';
require_once __DIR__ . '/../Model/Conducteur.php';
require_once __DIR__ . '/../Model/Article.php';
require_once __DIR__ . '/../Model/Sitee.php';
require_once __DIR__ . '/../Model/Depot.php';
require_once __DIR__ . '/../Model/Arret.php';
require_once __DIR__ . '/../Model.Tournee.php';



Class ItineraireController {

    private $tournee;

    //fonction pour trouver les temps de trajet entre chaque point
    private function findTime($data_itineraire, $nb){
        $time = array();
        $i = 0;

        for($i=0; $i <= $nb ; $i++){
            $time[$i] = $data_itineraire->trips[0]->legs[$i]->duration;
        }
        return $time;
    }

    //Creation de l'url pour faire l'itinéraire 
    private function createUrlApi(){

    }

    //fonction pour trouver l'order des endroit où aller
    private function findOrder($data_itineraire, $nb){
        $order = array();
        $i = 0;

        for($i=0; $i <= $nb ; $i++){
        $order[$i] = $data_itineraire->waypoints[$i]->waypoint_index;
        }
        return $order;
    }


  

    //fonction pour trouvé les articles donné qui n'nont pas encore été récupérés
    // private function findArticleDonne($data_product, $id){
    //     $i = 0;
    //     $index = [];
    //     $nb = 0;
    //     foreach($data_product as $product){
    //         if($product->DepositeryID == $id and $product->StatutID == 2){
    //             $index[$nb] = $i;
    //             $nb++;
    //         }
    //         $i++;
    //     }
    //     return $index;
    // }

    private function findItineraire($data_itineraire, $nbArret){
        
        $point = array();

        for($i=0; $i<$nbArret ; $i++){
            for($j=0 ; $j<$nbArret ; $j++){

            }
        }
    }

    public function new(){
        $controller = new SiteController();
        $sites = $controller->getAll();
        require_once __DIR__ .  '/../public/View/ItineraireView.php';
    }

    public function SiteNTrucks(){
        $siteId = $_POST["siteId"];
        $this->tournee = new Tournee();
        if($this->ChoseSite($siteId)){   
            $truckController = new TruckController();
            $trucks = $truckController->getBySite($site->getId());
            
            $freeTrucks = array();
            foreach($trucks as $truck){
                if($truck->getLibre()){
                   array_push($freeTrucks, $truck);
                }
            }
            http_response_code(201);
            echo(json_encode($freeTrucks));
        }else{
            http_response_code(400);
        }
	}

    public function TruckNEmployes(){
        $truckId = $_POST['truckId'];
        if($this->tournee->ChoseTruck($truckId)){

            $employeeController = new EmployeeController();
            $employees = $employeeController->getByPermis(true);
            
            // permis et libre
            $result = array();
            foreach($employees as $employee){
                if($employee->getLibre()){
                    $new = array('id' => $employee->getId(), 'name' => $employee->getName(), 'surname' => $employee->getSurname());
                    array_push($result, $new);
                }
            }
            http_response_code(201);
            echo(json_encode($result));
        }else{
            http_response_code(400);
        }

    }

    public function EmployeNTypes(){
        $userId = $_POST['id'];
        if($this->tournee->Chose($userId)){
            $typeC = new DeliveryTypeController();
            $types = $typeC->getAll();
            http_response_code(201);
            echo(json_encode($types));
        }
        else{
            http_response_code(400);
        }
    }

    public function Type(){
        $id = $_POST['id'];
        // $siteId = $_POST['id'];
        if($this->tournee->ChoseType($id)){
            http_response_code(201);
        }
        else{
            http_response_code(400);
        }
    }

    private function Distribuate($products, $users, $deliveryType){
        $res = array();
        if(count($products) != 0 && count($users) != 0){
            do{
                $sizeU = count($users) - 1;
                if($sizeU == 0){
                    $randU = 0;
                }else{
                    $randU = rand(1, $sizeU); 
                }
                $randUser = $users[$randU];

                $randNumber = rand(0, 5);
                $resProducts = array();
                $count = 0;
                do{
                    $count++;
                    $sizeP = count($products) - 1;
                    if($sizeP == 0){
                        $randP = 0;
                    }else{
                        $randP = rand(1, $sizeP);
                    }
                    $randProduct = $products[$randP];
                    array_push($resProducts, $randProduct);
                    array_splice($products, $randP, 1);
                }while(!($randNumber - $count > 0) && !(count($products) >= 1));
                
                $array = array(
                    "Id" => $randUser->getId(),
                    "Nom" => $randUser->getName(),
                    "Numero" => $randUser->getNumero(), 
                    "Rue" => $randUser->getRue(),
                    "Postcode" => $randUser->getPostcode(),
                    "Area" =>$randUser->getArea(),
                    "Products" => $resProducts,
                    "Type" => $deliveryType
                );
                array_push($res, $array);
                array_splice($users, $randU, 1);
            }while(count($users) >= 1);
            echo(json_encode($res));
            http_response_code(201);
        }else{
            http_response_code(400);
        }
    }

    public function SearchStops(){
        $typeId = $_POST['type'];
        if($typeId != null){
            $deliveryTypeController = new DeliveryTypeController();
            $deliveryType = $deliveryTypeController->getById($typeId);

            if($deliveryType != null){
                $productC = new ProductController();
                $products = array();
                $name = $deliveryType->getName();

                $user = array();
                $saleman = array();
                $donator = array();

                $individualC = new IndividualController();
                $salemanC = new SalemanController();
                $userC = new UserController();

                if($name == 'delivery'){
                    $products = $productC->getByStatut(3);
                    $user = $individualC->getByEligibility(1);
                    $this->Distribuate($products, $user, $name);
                }else if($name == 'collection'){
                    $products = $productC->getByStatut(2);
                    $saleman = $salemanC->getAll();
                    foreach($products as $product){
                        array_push($donator, $product->getDonator());
                    }
                    foreach($saleman as $s){
                        array_push($user, $userC->getById($s->getId()));
                    }
                    foreach($donator as $d){
                        if(!in_array($d, $user)){
                            array_push($user, $userC->getById($d->getId()));
                        }
                    }
                    $this->Distribuate($products, $user, $name);  
                }
            }else{
                http_response_code(400);
            }
        }else{
            http_response_code(400);
        }
    }

    public function CreateDelivery(){
        $typeId = $_POST['type'];
        $employeeId = $_POST['user'];
        $truckId = $_POST['truck'];
        $dateHour = $_POST['dateHour'];

        if($employeeId != null && $truckId != null && $dateHour != null){
            $deliveryTypeController = new DeliveryTypeController();
            $deliveryType = $deliveryTypeController->getById($truckId);

            // $truckC = new TruckController();
            // $truck = $truckC->getById($truckId);

            // $employeeC = new EmployeeController();
            // $employee = $employeeC->getById($employeeId);

            // if($employee != null && $truck != null && $deliveryType != null){
            if($deliveryType != null){

                // $deliveryController = new DeliveryController();
                // $delivery = new Delivery(null, $truck, $employee, $deliveryType, $dateHour, null);
                // $delivery->create();

                $productC = new ProductController();
                $products = array();
                $name = $deliveryType->getName();

                $user = array();
                $saleman = array();
                $donator = array();

                $individualC = new IndividualController();
                $salemanC = new SalemanController();
                $userC = new UserController();

                if($name == 'delivery'){
                    $products = $productC->getByStatut(3);
                    $user = $individualC->getByEligibility();
                }else if($name == 'collection'){
                    $products = $productC->getByStatut(2);
                    $saleman = $salemanC->getAll();
                    foreach($products as $product){
                        array_push($donator, $product->getDonator());
                    }
                    foreach($saleman as $s){
                        array_push($user, $userC->getById($s->getId()));
                    }
                    foreach($donator as $d){
                        if(!in_array($d, $user)){
                            array_push($user, $userC->getById($d->getId()));
                        }
                    }
                }
                $res = array(
                    'products' => $products,
                    'users' => $user
                );
                echo(json_encode($res));
                http_response_code(201);
            }else{
                http_response_code(400);
            }
        }else{
            http_response_code(400);
        }

                    // $stops = array();
            // foreach($stops as $stop){
                
            //     $mapStop = GmaApi::geocodeAddress($address);
            //     array_push($map, $mapStop);
            // }
            
            // foreach(){
    
            // }
            
            // $itineraiUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA";
    
            // $point_json = file_get_contents($itineraiUrl);
    
            // $data_itineraire = json_decode($point_json);
            // // foreach($data)
            // $order = $this->findOrder($data_itineraire, $nbArret);
            // $time = $this->findTime($data_itineraire, $nbArret);
            // $itineraiUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA";
        
    }

    public function GetCoordinates(){
        $address = $_POST['address'];
        $apikey = 'AIzaSyDgg-YLSCh-EyoIX31W_geAo8VYvYhnwq0';

        //valeurs vide par défaut
        $data = array('address' => '', 
                    'lat' => '', 
                    'lng' => '', 
                    'city' => '', 
                    'department' => '', 
                    'region' => '', 
                    'country' => '', 
                    'postal_code' => '');

        //on formate l'adresse
        $address = str_replace(" ", "+", $address);
        
        //on fait l'appel à l'API google map pour géocoder cette adresse
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=" . $apikey . "&address=$address&sensor=false&region=fr");
        $json = json_decode($json);

        
        //on enregistre les résultats recherchés
        if ($json->status == 'OK' && count($json->results) > 0) {
            $res = $json->results[0];
            //adresse complète et latitude/longitude
            $data['address'] = $res->formatted_address;
            $data['lat'] = $res->geometry->location->lat;
            $data['lng'] = $res->geometry->location->lng;
            foreach ($res->address_components as $component) {
                //ville
                if ($component->types[0] == 'locality') {
                    $data['city'] = $component->long_name;
                }
                //départment
                if ($component->types[0] == 'administrative_area_level_2') {
                    $data['department'] = $component->long_name;
                }
                //région
                if ($component->types[0] == 'administrative_area_level_1') {
                    $data['region'] = $component->long_name;
                }
                //pays
                if ($component->types[0] == 'country') {
                    $data['country'] = $component->long_name;
                }
                //code postal
                if ($component->types[0] == 'postal_code') {
                    $data['postal_code'] = $component->long_name;
                }
            }
        }
            echo json_encode($data);
    }

    public function Depot(){
        $depotId = $_POST['id'];
        if($depotId != null && $depotId != 0){
            $depositeryController = new DepositeryController();
            $depot = $depositeryController->getBySite($site->getId());

            http_response_code(201);
            echo(json_encode($depot));  
        }else{
            http_response_code(400);
        }
    }    


    public function GererateStops(){

    }
}

?>