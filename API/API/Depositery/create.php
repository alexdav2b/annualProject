<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/DepositeryService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Depositery.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

if(FieldValidator::validate($json, [
    'siteId',
    'numero',
    'rue',
    'postcode',
    'area',
    'capacity'])){

        $m = new Depositery(NULL,
                            $json['siteId'],
                            $json['numero'],
                            $json['rue'],
                            $json['postcode'],
                            $json['area'],
                            $json['capacity']
                             );
        $new = DepositeryService::getInstance()->create($m);
        if($new){
            http_response_code(201);
            echo json_encode($new);
        }
}

else{
	http_response_code(400);
}
?>