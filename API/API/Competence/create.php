<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/CompetenceService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Competence.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['name'])){
    $m = new Competence(NULL, $json['name']);
    $new = CompetenceService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>