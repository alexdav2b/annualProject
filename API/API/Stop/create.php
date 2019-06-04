<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/StopService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Stop.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);
var_dump($json);

if(FieldValidator::validate($json, ['DateHour'], ['DeliveryID'], ['UsrDonateID'], ['UsrReceiveID'])){
    $m = new Stop(NULL, $json['DateHour'], $json['DeliveryID'], $json['UsrDonateID'], $json['UsrReceiveID']);
    var_dump($m);
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