<?php

require_once __DIR__ . '/../Model/Adresse.php';
require_once __DIR__ . '/../Model/Vehicule.php';
require_once __DIR__ . '/../Model/Conducteur.php';
require_once __DIR__ . '/../Model/Article.php';
require_once __DIR__ . '/../Model/Sitee.php';
require_once __DIR__ . '/../Model/Depot.php';
require_once __DIR__ . '/../Model/Arret.php';
require_once __DIR__ . '/../Model/GmapApi.php';


Class ItineraireController {

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


    //fonction pour sélection un véhicule en fonction du site choisi
    private function getTruckByIdSite($data_truck, $id){
        foreach($data_truck as $truck){
            if($truck->SiteID == $id){
                return $truck;
            }
        }
        return null;
    }

    //fonction pour sélection une chauffeur (salarié) en fonction du site choisi
    private function getConducteurBySite($data_usr, $id){
        foreach($data_usr as $usr){
            if($usr->Discriminator == "Employer" and $usr->SiteID == $id){
                return $usr;
            }
        }
        return null;
    }

    //fonction pour trouver le dépot en fonction du site choisie
    private function findDepot($data_depot, $id){
        foreach($data_depot as $depot){
            if($depot->SiteID == $id){
                return $depot;
            }
        }
        return null;
    }

    //fonction pour trouvé les articles donné qui n'nont pas encore été récupérés
    private function findArticleDonne($data_product, $id){
        $i = 0;
        $index = [];
        $nb = 0;
        foreach($data_product as $product){
            if($product->DepositeryID == $id and $product->StatutID == 2){
                $index[$nb] = $i;
                $nb++;
            }
            $i++;
        }
        return $index;
    }

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


    public function ChoseSite(){
        $siteId = $_POST["siteId"];
        if($siteId != null && $siteId != 0 ){
            $siteController = new SiteController();
            $site = $siteController->getById(intval($siteId));
    
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

    public function ChoseTruck(){
        $truckId = $_POST['truckId'];
        if($truckId != null && $truckId != 0){
            $truckController = new TruckController();
            $truck = $truckController->getById(intval($truckId));
    
            $employeeController = new EmployeeController();
            $employees = $employeeController->getByPermis(1);
            
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

    public function ChoseEmployee(){
        $userId = $_POST['id'];
        if($userId != null && $userId != 0){
            $employeeController = new EmployeeController();
            $employee = $employeeController->getById(intval($userId));    
        
            $deliveryTypeController = new DeliveryTypeController();
            $types = $deliveryTypeController->getAll();
            http_response_code(201);
            echo(json_encode($types));
        }
        else{
            http_response_code(400);
        }
    }

    public function ChoseDeliveryType(){
        $deliveryTypeId = $_POST['id'];
        $siteId = $_POST['id'];
        if($deliveryTypeId != 0 && $deliveryTypeId != null){
            $deliveryTypeController = new DeliveryTypeController();
            $type = $deliveryTypeController->getById($deliveryTypeId);


            
            // $depositeryController = new DepositeryController();
            // $depots = $depositeryController->getBySite($site->getId());


            http_response_code(201);

        }
        else{
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

            $truckC = new TruckController();
            $truck = $truckC->getById($truckId);

            $employeeC = new EmployeeController();
            $employee = $employeeC->getById($employeeId);

            if($employee != null && $truck != null && $deliveryType != null){
                $deliveryController = new DeliveryController();
                $delivery = new Delivery(null, $truck, $employee, $deliveryType, $dateHour, null);
                $delivery->create();
                // http_response_code(201);

                $productC = new ProductController();
                $products = array();
                $name = $deliveryType->getName();
                if($name == 'delivery'){
                    $products = $productC->getByStatut(3);
                }else if($name == 'collection'){
                    $products = $productC->getByStatut(2);
                }      
                
                $stopToCreate = array();
                foreach($products as $product){

                    $stopProduitC = new StopProductController();
                    // if null

                    $stopProduitsId = $stopProduitC->getByProductId($product->getId());

                    if($stopProduitsId == null){
                        // créer stop
                        // $stop = new Stop(null, null, )                        
                        // créer stop product
                    }
                    
                    $stopC = new StopController();
                    // $stops = $stopC->get
                }

                
                http_response_code(201);
                echo(json_encode($products));
            }else{
                http_response_code(400);
            }
        }else{
            http_response_code(400);
        }
    }

    public function ChoseStart(){
        $depotId = $_POST['id'];
        if($depotId != null && $depotId != 0){
            $depositeryController = new DepositeryController();
            $depot = $depositeryController->getBySite($site->getId());
            
            // Générer les stops
            http_response_code(201);
            echo(json_encode($depot));  
        }
 
    }    

    public function GererateStops(){
        // recuperer tous les produits du type de la livraison
        // Créer un stop
        // Y ajouter les produits
    }

    public function view(){
        // Date
        $date = $_POST['date'];
        $siteId = $_POST['site'];

        // Chercher le site posté
        // $siteController = new SiteController();
        // $site = $siteController->getById($siteId);

        // Chercher les camions libres pour le site
        // $truckController = new TruckController();
        // $trucks = $truckController->getBySite($site->getId());
        
        // $freeTrucks = array();
        // foreach($trucks as $truck){
        //     if($truck->getLibre()){
        //         array_push($freeTrucks, $truck);
        //     }
        // }

        // Chercher les employés du site // permis
        // $employeeController = new EmployeeController();
        // $employees = $employeeController->getAll();

        // Chercher les types de livraisons
        // $deliveryTypeController = new DeliveryTypeController();
        // $types = $deliveryTypeController->getAll();

        // Créer la livraison
        // Choisir truck, Choisir employee, Choisir Type
        die();
        $delivery = new Delivery(null, $truck, $employee, $type, $date, null);

        // Chercher les entrepots du site
        $depositeryController = new DepositeryController();
        $depots = $depositeryController->getBySite($site->getId());
        $itineraiUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA";

        // Chercher les produits des entrepots du site 
        $productController = new ProductController();
        $produitsTousEntrepots = array();
        
        foreach($depots as $depot){
            $produits = $productController->getByDepositery($depot->getId());
            
            $produitsTousEntrepots = array_merge($produitsTousEntrepots, $produits);
        }

        // Chercher les produits de statut 2 (donné)
        $produitsDonnes = array();
        foreach($produitsTousEntrepots as $produit){
            if($produit->getStatut()){
                array_push($produitsDonnes, $produit);
            }
        }

        // créer les stops
        // $stop = new Stop(null, $date, )
        
        // créer les stops produits

        // passer les stops en coordonnées

        $nbarticle = count($produitsDonnes);
        

        
        $mapDepot = GmapApi::geocodeAddress($depot->getAddress);
        $mapStops = array(); 
        // foreach()
        array_push($mapArray, $depot); // sélectionner le dépôt
        // Chercher les produits

        // $truck = $truckController->getById();

        // $url = 'http://fightfoodwasteapi/';
        // $json_site = file_get_contents($url.'site/'.$_POST['site']);
        // $site_data = json_decode($json_site);

        // $s = new Sitee($site_data->ID, $site_data->Name);


        // $json_truck = file_get_contents($url.'/truck');
        // $truck_data = json_decode($json_truck);

        // $truck = $this->getTruckByIdSite($truck_data, $s->getId());

        // $truck = $this->getTruckByIdSite($trucks, )

        //Aller le chercher en bdd
        // $v = new Vehicule($truck->ID, $truck->Plate, $truck->Name, $truck->Capacity);

        //recherche en bdd de tous les user
        // $json_usr = file_get_contents($url.'/usr');
        // $usr_data = json_decode($json_usr);

        //fonction qui recherche un salarié
        // $usr = $this->getConducteurBySite($usr_data,  $s->getId());

        //construction d'un salarié
        // $c = new Conducteur ($usr->ID, $usr->Surname, $usr->Name, $usr->Email );

        
        
        
        
        
        //choix du salarié
        // $d = $_POST['date'];

        // $json_depot = file_get_contents($url.'/depositery');
        // $depot_data = json_decode($json_depot);

        // $depot_temp = $this->findDepot($depot_data, $s->getId());

        // //en fonction du site, trouvé le dépot en bddd, instancier de dépot
        // $depot = new Depot ($depot_temp->ID, $depot_temp->Numero, $depot_temp->Rue, $depot_temp->Postcode, $depot_temp->Area, $depot_temp->Capacity);

        // $json_product = file_get_contents($url.'/product');
        // $product_data = json_decode($json_product);

        // $index = $this->findArticleDonne($product_data, $depot->getID());

        // $nbarticle = count($index);

        // $articles = [];

        $tabIdDonnateur = [];
        $nbArret = 0;

        // $itineraiUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA";

        // $point_json = file_get_contents($itineraiUrl);
        // $data_itineraire = json_decode($point_json);

        // $order = $this->findOrder($data_itineraire, $nbArret);

        // $time = $this->findTime($data_itineraire, $nbArret);

        require_once __DIR__ . '/../public/View/MapView.php';
    }

}

?>