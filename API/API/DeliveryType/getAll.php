<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/DeliveryTypeService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/DeliveryType.php';


$new = DeliveryTypeService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>