<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/StopService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Stop.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['usrDonateId'])){
    $m = new Stop(NULL, $json['dateHour'], $json['deliveryId'], $json['usrDonateId'], $json['usrReceiveId']);
    $new = StopService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>