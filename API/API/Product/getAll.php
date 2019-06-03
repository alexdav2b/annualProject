<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/ProductService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Product.php';


$new = ProductService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>