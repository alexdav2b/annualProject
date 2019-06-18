<?php

require_once __DIR__ . '/../public/Router/Router.php';

$router = new Router($_GET['url']);

$router->get('/', "Pages#home");

// $router->get('/comptes', function() { echo 'Tous les comptes'; });

$router->get('/comptes', "Comptes#show");

$router->get('/compte/:id', function($id){echo 'Votre compte' . $id; });

$router->post('/compte/:id', function($id){echo 'Poster pour le compte' . $id; });

$router->run();


// use $router
// echo $router->url('Post#show', ['id' => 1, 'slug' => 'salut-les-gens']);
?>