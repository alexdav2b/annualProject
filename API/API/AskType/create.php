<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/AskTypeService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/AskType.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['name'])){
    $m = new AskType(NULL, $json['name']);
    $new = AskTypeService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>