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


// $router->get('/users', "Individual#viewAll");

// ADHESIONS
// -------------------------------------------------------------------

$router->get('/adhesion/:id', "Adhesion#viewUser");

$router->get('/adhesions', "Adhesion#viewAll");

// TRUCK
// -------------------------------------------------------------------

$router->get('/trucks', "Truck#viewAll");

$router->get('/trucks/:site', "Truck#viewBySite");

$router->get('/truck/:id', "Truck#view");


// DELIVERIES
// -------------------------------------------------------------------

$router->get('/deliveries', "Delivery#viewAll");
$router->get('/delivery/:id', "Delivery#view");


// PRODUCT
// -------------------------------------------------------------------


// STOP
// -------------------------------------------------------------------



// SITES
// -------------------------------------------------------------------

$router->get('/sites', "Site#viewAll");

$router->get('/site/:id', "Site#view");


// USERS
// -------------------------------------------------------------------

// Individual
$router->post('/log/particulier', "Individual#Inscription");

$router->post('/particulier/update/:id', "Individual#Modification");

$router->get('/particulier/:id', "Individual#view");




// Saleman
$router->post('/log/particulier', "Saleman#Inscription");

// Employee

// Admin

// Run
// -------------------------------------------------------------------


$router->run();


// use $router
// echo $router->url('Post#show', ['id' => 1, 'slug' => 'salut-les-gens']);
?>