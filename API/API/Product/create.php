<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/ProductService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Product.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, [
    'depositeryId',
    'name',
    'barcode',
    'validDate'
    ])){

        $m = new Product(NULL,
                            $json['depositeryId'],
                            $json['name'],
                            $json['barcode'],
                            $json['validDate']
                             );
        $new = ProductService::getInstance()->create($m);
        if($new){
            http_response_code(201);
            echo json_encode($new);
        }
}

else{
	http_response_code(400);
}
?>