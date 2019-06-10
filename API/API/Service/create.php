<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/ServiceService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Service.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['name'])){
    $m = new Service(NULL, $json['name']);
    $new = ServiceService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>