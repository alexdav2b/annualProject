<?php

Class PagesController {

    public function home(){
        $title = "Fight Food Waste";

        ob_start();

        echo ('test');

        $content = ob_get_clean();
        require_once __DIR__ . '/../View/templateView.php';
    }

    public function about(){
        $content = '';
        
    }
}