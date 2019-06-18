<?php

require_once __DIR__ . '/../public/Router/Router.php';

$router = new Router($_GET['url']);

// Pages

$router->get('/', "Pages#home");

$router->get('/log', "Pages#log");

$router->get('/about', "Pages#about");

// User

$router->get('/compte/:id', "User#view");

$router->get('/comptes', "User#viewAll");

// $router->post('/compte/:id', function($id){echo 'Poster pour le compte' . $id; });

// $router->get('/users', "Individual#viewAll");

// Adhesion

$router->get('/adhesion/:id', "Adhesion#viewUser");

$router->get('/adhesions', "Adhesion#viewAll");

// Truck

$router->get('/trucks', "Truck#viewAll");

$router->get('/trucks/:site', "Truck#viewBySite");

$router->get('/truck/:id', "Truck#view");


// Delivery

$router->get('/deliveries', "Delivery#viewAll");
$router->get('/delivery/:id', "Delivery#view");


// Product


// Stop


// Site

$router->get('/sites', "Site#viewAll");

$router->get('/site/:id', "Site#view");


// Test

$router->post('/log/Individual', "Individual#Inscription");

$router->post('/log/Saleman', "Saleman#Inscription");

$router->get('/indi', "Individual#view");
// Run

$router->run();


// use $router
// echo $router->url('Post#show', ['id' => 1, 'slug' => 'salut-les-gens']);
?>