<?php

require_once __DIR__ . '/../public/Router/Router.php';

$router = new Router($_GET['url']);

// PAGES
// -------------------------------------------------------------------

$router->get('/', "Pages#home");

$router->get('/log', "Pages#log");

$router->get('/about', "Pages#about");

$router->get('/404', "Pages#notFound");


// ADHESIONS
// -------------------------------------------------------------------

$router->get('/adhesion/:id', "Adhesion#viewOne"); // id

$router->get('/adhesions/:id', "Adhesion#viewUser"); // idUser => Saleman

$router->get('/adhesions', "Adhesion#viewAll"); // admin

$router->get('/adhesion', "Adhesion#New"); //

$router->post('/adhesion', "Adhesion#New"); //


// TRUCK
// -------------------------------------------------------------------

// $router->get('/trucks', "Truck#viewAll");

// $router->get('/trucks/:site', "Truck#viewBySite");

// $router->get('/truck/:id', "Truck#view");


// DELIVERIES
// -------------------------------------------------------------------

// $router->get('/deliveries', "Delivery#viewAll");

// $router->get('/delivery/:id', "Delivery#view");


// PRODUCT
// -------------------------------------------------------------------


// STOP
// -------------------------------------------------------------------



// SITES
// -------------------------------------------------------------------

// $router->get('/sites', "Site#viewAll");

// $router->get('/site/:id', "Site#view");


// USERS
// -------------------------------------------------------------------

// All
$router->get('/compte/delete/:id', "User#Suppression"); //

// Individual
$router->post('/log/particulier', "Individual#Inscription");

$router->post('/particulier/update/:id', "Individual#Modification");

$router->get('/particulier/:id', "Individual#view");

// Saleman
$router->post('/log/commercant', "Saleman#Inscription"); 

$router->post('/commercant/update/:id', "Saleman#Modification"); 

$router->get('/commercant/:id', "Saleman#view"); 

// Employee
$router->post('/log/employe', "Employee#Inscription"); //

$router->post('/employe/update/:id', "Employee#Modification"); 

$router->get('/employe/:id', "Employee#view"); 


// Admin
$router->get('/comptes', "User#viewAll");

$router->post('/admin/update/:id', "Admin#Modification"); // Controller

$router->get('/admin/:id', "Admin#view"); // Controller


// RUN
// -------------------------------------------------------------------

$router->run();


// use $router
// echo $router->url('Post#show', ['id' => 1, 'slug' => 'salut-les-gens']);
?>