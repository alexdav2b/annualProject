<?php

require_once __DIR__ . '/../public/Router/Router.php';

$router = new Router($_GET['url']);

// Pages

$router->get('/', "Pages#home");

$router->get('/log', "Pages#log");

$router->get('/about', "Pages#about");

// User

$router->get('/compte/:id', "User#view");

$router->get('/comptes', "Comptes#show");



$router->post('/compte/:id', function($id){echo 'Poster pour le compte' . $id; });



$router->run();


// use $router
// echo $router->url('Post#show', ['id' => 1, 'slug' => 'salut-les-gens']);
?>