<?php

Class PagesController {

    public function home(){
        require_once __DIR__ . '/../public/View/homeView.php';
    }

    public function about(){
        $title = "Fight Food Waste - About us";

        require_once __DIR__ . '/../public/View/connexionView.php';
        
    }

    public function notFound(){
        require_once __DIR__ . '/../public/View/notFoundView.php';
    }

    public function log(){
        $controller = new SiteController();
        $sites = $controller->getAll();
        require_once __DIR__ . '/../public/View/connexionView.php';     
    }

}