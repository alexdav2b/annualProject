<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response; 
use Slim\Interfaces\RouteInterface;

require "../Composer/vendor/autoload.php";

session_start();

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


$container = $app->getContainer();

$app->post('/{table}/create',\App\Controllers\PagesController::class . ':create');

$app->put('/{table}/update',\App\Controllers\PagesController::class . ':update');

$app->delete('/{table}/delete/{id}', \App\Controllers\PagesController::class . ':delete');

$app->get('/{table}/{id}', \App\Controllers\PagesController::class . ':getById');

$app->get('/{table}/{column}/{value}/getByString', \App\Controllers\PagesController::class . ':getByString');

$app->get('/{table}/{column}/{value}/getByInt', \App\Controllers\PagesController::class . ':getByInt');

$app->get('/{table}', \App\Controllers\PagesController::class . ':getAll');

$app->get('/requests', \App\Controllers\PagesController::class . ':showRequests');


$app->run();