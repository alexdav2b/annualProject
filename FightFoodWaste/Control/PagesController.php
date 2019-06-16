<?php

Class PagesController {

    public function home(){
        $title = "Fight Food Waste";

        ob_start();

        echo ('test');

        $content = ob_get_clean();
        require_once __DIR__ . '/../public/View/templateView.php';
    }

    public function about(){
        $title = "Fight Food Waste - About us";

        ob_start();

        echo ('About us');

        $content = ob_get_clean();

        require_once __DIR__ . '/../public/View/templateView.php';
        
    }

    public function log(){
        require_once __DIR__ . '/../public/View/connexionView.php';     
    }


}