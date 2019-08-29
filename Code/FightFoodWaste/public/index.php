<?php

require_once __DIR__ . '/../public/Router/Router.php';

$router = new Router($_GET['url']);

if(!isset($_SESSION['User'])){
    session_start();
}

// PAGES
// -------------------------------------------------------------------

$router->get('/', "Pages#home");

$router->get('/log', "Pages#log");

$router->get('/about', "Pages#about");

$router->get('/404', "Pages#notFound");


// ADHESIONS
// -------------------------------------------------------------------

//$router->get('/adhesion/:id', "Adhesion#viewOne"); // id

$router->get('/adhesions/:id', "Adhesion#viewUser"); // idUser => Saleman

// $router->get('/adhesions', "Adhesion#viewAll"); // admin

$router->get('/adhesion', "Adhesion#New"); //

$router->post('/adhesion', "Adhesion#Add"); //

$router->get('/adhesion/Facture/:id', "Adhesion#Invoice"); // pdf

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
$router->get('/compte/delete/:id', "User#Suppression"); 

// Individual
$router->post('/log/particulier', "Individual#Inscription"); 

$router->post('/particulier/update/:id', "Individual#Modification");  

$router->get('/particulier/:id', "Individual#view");

// Saleman
$router->post('/log/commercant', "Saleman#Inscription"); 

$router->post('/commercant/update/:id', "Saleman#Modification"); 

$router->get('/commercant/:id', "Saleman#view"); 

// Employee
$router->get('/employe/new', "Employee#New"); 

$router->post('/log/employe', "Employee#Inscription");

$router->post('/employe/update/:id', "Employee#Modification"); 

$router->get('/employe/:id', "Employee#view"); 

// Volunteer

$router->get('/volontaire/new', "Volunteer#New"); 

$router->post('/log/volontaire', "Volunteer#Inscription");

// $router->post('/volontaire/update/:id', "Volunteer#Modification"); // Verifier Admin || User

$router->get('/volontaire/:id', "Volunteer#view"); 


// -------------------------------------------------------------------
// Admin
$router->get('/admin/new', "Admin#New");

$router->post('/log/admin', "Admin#Inscription");

$router->get('/comptes', "User#viewAll");

$router->post('/admin/update/:id', "Admin#Modification");  // Verifier Admin || User

$router->get('/admin/:id', "Admin#view"); 

// Connexion - Déconnexion
$router->post('/connexion', "User#Connexion");

$router->get('/deconnexion', "User#Deconnexion");

$router->post('/mdp', "User#MotDePasseOublie");

// ITINERAIRE
// -------------------------------------------------------------------

$router->get('/itineraire', "Itineraire#new");

$router->post('/itineraire/Site', "Itineraire#ChoseSite");

$router->post('/itineraire/Truck', 'Itineraire#ChoseTruck');

$router->post('/itineraire/Employee', 'Itineraire#ChoseEmployee');

$router->post('/itineraire/Delivery', 'Itineraire#ChoseDeliveryType');

// $router->post('/itineraire/Start', 'Itineraire#ChoseStart');

$router->post('itineraire/CreateDelivery', 'Itineraire#CreateDelivery');

$router->post('/itineraire', "Itineraire#view");

// RUN
// -------------------------------------------------------------------

$router->run();

?>