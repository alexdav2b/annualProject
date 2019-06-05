<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/AdhesionService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Adhesion.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['id', 'userId', 'dateAdhesion', 'cb', 'code'])){
    $m = new Adhesion($json['id'], $json['userId'], $json['dateAdhesion'], $json['cb'], $json['code']);
    $new = AdhesionService::getInstance()->update($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>