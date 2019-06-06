<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/User.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);


if(FieldValidator::validate($json, ['email'])){
    $m = $json['email'];
    $new = UserService::getByEmail($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>