<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/TruckService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Truck.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, [
    'siteId',
    'plate',
    'name',
    'capacity'
    ])){

        $m = new Truck(NULL,
                            $json['siteId'],
                            $json['plate'],
                            $json['name'],
                            $json['capacity']
                             );
        $new = TruckService::getInstance()->create($m);
        if($new){
            http_response_code(201);
            echo json_encode($new);
        }
}

else{
	http_response_code(400);
}
?>