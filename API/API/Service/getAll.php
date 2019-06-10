<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/ServiceService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Service.php';


$new = ServiceService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>