<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/JustificatifService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Justificatif.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['userId', 'competenceId'])){
    $m = new Justificatif(NULL, $json['link'], $json['userId'], $json['competenceId']);
    $new = JustificatifService::getInstance()->create($m);

    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>