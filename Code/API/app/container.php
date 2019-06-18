<?php

$container = $app->getContainer();

// Register component on container :
/*
- Créé une clé pour view
- instance objet twig (chemin vers template)
*/
$container['view'] = function ($container) {
    $dir = dirname(__DIR__); // dossier parent au fichier actuel
    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => false //$dir . '/tmp/cache'
    ]);

    // // Instantiate and add Slim specific extension

    // $router = $container->get('router');
    // $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// name
?>