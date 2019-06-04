<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/StopService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Stop.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['id', 'dateHour', 'deliveryID', 'usrDonateID', 'usrReceiveID']])){
    $m = new Stop ($json['id'], $json['dateHour'], $json['deliveryID'], $json['usrDonateID'], $json['usrReceiveID']);
    $new = StopService::getInstance()->update($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>
