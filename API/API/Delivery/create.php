<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/DeliveryService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Delivery.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);
var_dump($json);
if(FieldValidator::validate($json, ['truckId', 'userId', 'deliveryTypeId', 'dateStart', 'dateEnd'])){
    $m = new Delivery(NULL, $json['truckId'], $json['userId'], $json['deliveryTypeId'], $json['dateStart'], $json['dateEnd']);
    $new = DeliveryService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>