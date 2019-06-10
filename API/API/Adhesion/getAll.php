<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/AdhesionService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Adhesion.php';


$new = AdhesionService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>