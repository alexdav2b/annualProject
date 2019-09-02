<?php

require_once __DIR__ . '/../Model/Employee.php';
require_once __DIR__ . '/../Model/DeliveryType.php';
require_once __DIR__ . '/../Model/Truck.php';
require_once __DIR__ . '/../Model/Site.php';


Class Delivery implements JsonSerializable{

	private $id;
	private $truck;
	private $employee;
	private $type; // 1.
	private $dateStart;
	private $dateEnd;
	private $url;


	private $site; // 2.
	private $stops;
	private $depot;
	// private $employeeNproduits;
    
    public function __construct(?int $id, ?Truck $truck, ?Employee $employee, ?DeliveryType $type, $dateStart, $dateEnd, ?string $url){
        $this->id = $id;
		$this->truck = $truck;
		$this->employee = $employee;
		$this->type = $type;
		$this->dateStart = $dateStart;
		$this->dateEnd = $dateEnd;
		$this->url = $url;
    }


	/* =================================================================================
	   DATABASE 
	*/

    public function getId(): ?int{ return $this->id; }
	public function getTruck(): Truck{ return $this->truck; }
	public function getEmployee(): ?Employee{ return $this->employee; }
	public function getType(): DeliveryType{ return $this->type; }
	public function getDateStart() { return $this->dateStart; }
	public function getDateEnd() { return $this->dateEnd; }
	public function getUrl(){ return $this->url; }

    public function setId(int $id){
        if($id > 0){
            $this->id = $id;
        }
    }
    
    public function setTruck(int $truckId){
		$controller = new TruckController();
		$truck = $controller->getById($truckId);
		$this->truck = $truck;
	}
	
	public function setEmployee(int $employeeId){
		$controller = new EmployeeController();
		$employee = $controller->getById($employeeId);
		$this->employee = $employee;
	}

	public function setType(int $deliveryTypeId){
		$controller = new DeliveryTypeController();
		$type = $controller->getById($deliveryTypeId);
		$this->type = $type;
	}

	public function setDateStart($date){ $this->dateStart = $date; }

	public function setDateEnd($date){ $this->dateEnd = $date; }

	public function setUrl($url){ $this->url = $url; }

	public function create() : bool{
		$api = new ApiManager('Delivery');
		if($this->id != null){
			return false;
		}
		$array = array(
			'TruckID' => $this->truck->getId(),
			'UsrID' => $this->employee->getId(),
			'DeliveryTypeID' => $this->type->getId(),
			'DateStart' => $this->dateStart,
			'DateEnd' => $this->dateEnd);
		$json = json_encode($array);
		$json = $api->create($json);
		if ($json != NULL){
			$this->id = $json['ID'];
			return true;
		}
		return false;
	}

	public function delete(): bool{
		$api = new ApiManager('Delivery');
		$json = $api->delete($this->id);
		return $json['Success'];
    }
    
	public function update(string $discriminator): bool{
		$api = new ApiManager('Delivery');
        $array = array(
            'ID' => $this->id, 
			'TruckID' => $this->truck->getId(),
			'UsrID' => $this->employee->getId(),
			'DeliveryTypeID' => $this->type->getId(),
			'DateStart' => $this->dateStart,
			'DateEnd' => $this->dateEnd);
		$json = json_encode($array);
		$json = $api->update($json);
		if ($json != NULL){
			return true;		
		}
		return false;
	}

	public function jsonSerialize(){
		return get_object_vars($this);
	}

	/* =================================================================================
	   GENERATION 
	*/
	public function getAddress($stop){
		return $stop["Numero"] .' '. $stop["Rue"] .' '. $stop["Postcode"] .' '.$stop["Area"]; 
	}

	public function getSite(): ?Site{ return $this->site; }
	public function setSite(int $siteId){
		$controller = new SiteController();
		$site = $controller->getById($siteId);
		$this->site = $site; $this->site = $site; 
	}

	public function getStops(): ?array{ return $this->stops; }
	public function setStops(array $stops){ $this->stops = $stops; }
	public function addStop(Stop $stop){ array_push($this->stops, $stop); }
	// public function removeStop(Stop $stop){ array_slice($this->stops, )}

	public function getDepot(): Depositery{ 
		return $this->depot; 
	}
	public function setDepot(int $depotId){ 
		$controller = new DepositeryController();
		$depot = $controller->getById($depotId);
		$this->depot = $depot; 
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
					"Type" => $deliveryType,
					"Ordre" => null,
					"DateHour" => null
                );
                array_push($res, $array);
                array_splice($users, $randU, 1);
            }while(count($users) >= 1);
            return $res;
        }else{
            return null;
        }
    }

	public function SearchStops(){
		$type = $this->type;
		if($type != null){
			$productC = new ProductController();
			$products = array();
			$name = $type->getName();

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
				return $this->Distribuate($products, $user, $name);  
			}
		}
		return null;
	}
	
	// public function GetCoordinates($stop){
	// 	$startUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=";
	// 	$endUrl = "+CA&key=".GOOGLE;
	// 	$res = array();
	// 	$adresses = array();

	// 	$adress = $stop["Numero"] .' '. $stop["Rue"] .' '. $stop["Postcode"] .' '.$stop["Area"]; 
	// 	$url = $startUrl . urlencode($adress) . $endUrl;
	// 	$urlHeader =@get_headers($url);
	// 	if($urlHeader[0] =='HTTP/1.1 404 Not Found'){
	// 		return null;
	// 	}else{
	// 		$json = file_get_contents($url);
	// 		return $json;
	// 	}
	// 	return $res;
	// }

	public function GetCoordinates($stops){
		$startUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=";
		$endUrl = "+CA&key=".GOOGLE;
		$res = array();
		$adresses = array();
		foreach($stops as $stop){
			$adress = $this->getAddress($stop); 
			$url = $startUrl . urlencode($adress) . $endUrl;
			$urlHeader =@get_headers($url);
			if($urlHeader[0] =='HTTP/1.1 404 Not Found'){
				$stop["Lat"] = 
				array_push($res, null);
			}else{
				$json = file_get_contents($url);
				array_push($res, $json);
			}
		}
		return $res;
	}

	public function GenerateItinerary($stops, $start, $end, $dateStart){
		// $startUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=";
		
		$dateStart = urlencode($dateStart->format("Y-m-d H:i:s"));

		$start = urlencode($start);
		$end = urlencode($end);

		$startUrl = 'https://maps.googleapis.com/maps/api/directions/json?origin=';
		$url = $start .'&destination=' . $end . ',&waypoints=optimize:true';
		$endUrl = '&dirflg=r&timeType=Departure&dateTime='.$dateStart.'&key='.GOOGLE;

		foreach($stops as $stop){
			$address = $this->getAddress($stop);
			$url .= '|' . urlencode($address);
		}
		$link = $startUrl . $url . $endUrl;
		$urlHeader = @get_headers($link);
		if($urlHeader[0] =='HTTP/1.1 404 Not Found'){
			return null;
		}else{
			$this->setUrl($url);
			return $url;
		}
	}
}

?>