<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/User.php';


$new = UserService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>