<?php
// Objectif : repondre a une requete http

// sortie content type = json
header("Content-Type: application/json");

require_once __DIR__ . '/../../Services/SiteService.php';
require_once __DIR__ . '/../../Utils/FieldValidator.php';
require_once __DIR__ . '/../../Models/Site.php';

$content =  file_get_contents('php://input');
$json = json_decode($content, true);


$new = SiteService::getAll();
if($new){
    http_response_code(201);
    echo json_encode($new);
}

?>