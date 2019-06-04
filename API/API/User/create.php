<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/User.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);

var_dump($json);
if(FieldValidator::validate($json, [
    'siteId',
    'email',
    'name',
    'password',
    'numero',
    'rue',
    'postcode',
    'area',
    'eligibility',
    'discriminator'
    ])){

        $m = new User(NULL,
                            $json['siteId'],
                            $json['serviceId'],
                            $json['email'],
                            $json['name'],
                            $json['surname'],
                            $json['password'],
                            $json['numero'],
                            $json['rue'],
                            $json['postcode'],
                            $json['area'],
                            $json['eligibility'],
                            $json['siret'],
                            $json['salary'],
                            $json['discriminator']
                        );
        $new = UserService::getInstance()->create($m);
        if($new){
            http_response_code(201);
            echo json_encode($new);
        }
}

else{
	http_response_code(400);
}
?>