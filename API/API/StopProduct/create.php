<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/StopProductService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/StopProduct.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, ['stopId', 'productId'])){
    $m = new StopProduct($json['stopId'], $json['productId']);
    $new = StopProductService::getInstance()->create($m);
    if($new){
        http_response_code(201);
        echo json_encode($new);
    }
}

else{
	http_response_code(400);
}
?>