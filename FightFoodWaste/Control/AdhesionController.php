<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Adhesion.php';
require_once __DIR__ . '/../Model/User.php';

Class AdhesionController{

    // Parse

    private function parseOne($json) : Adhesion{
        $userController = new UserController();
        $user = $userController->getById(intval($json['UsrID']));
        $adhesion = new Adhesion($json['ID'], $json['DateAdhesion'], $json['Cb'], $json['Code'], $user);
        return $adhesion;
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){

            $userController = new UserController();
            $user = $userController->getById(intval($line['UsrID']));

            $adhesion = new Adhesion($line['ID'], $line['DateAdhesion'], $line['Cb'], $line['Code'], $user);
            array_push($result, $adhesion);
        }
        return $result;
    }

    // Database

    public function getAll() : array{
        $api = new ApiManager('Adhesion');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getById(int $id){
        $api = new ApiManager('Adhesion');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getByDate($date){
        $api = new ApiManager('Adhesion');
        $json = $api->getByString('DateAdhesion', $date);
        return $this->parseAll($json);
    }

    public function getByCb(string $cb){
        $api = new ApiManager('Adhesion');
        $json = $api->getByString('Cb', $cb);
        return $this->parseAll($json);
    }

    public function getbyCode(string $code){
        $api = new ApiManager('Adhesion');
        $json = $api->getByString('Code', $code);
        return $this->parseAll($json);
    }

    public function getByUser(int $idUser){
        $api = new ApiManager('Adhesion');
        $json = $api->getByInt('UsrID', $idUser);
        return $this->parseAll($json);
    }

    // Views

    public function view(int $id){
        $adhesion = $this->getById($id);
        if($adhesion != NULL){
            require_once __DIR__ . '/../public/View/adhesionGestionView.php';
        }
    }

    public function viewAll(){
        $adhesions = $this->getAll();
        if($adhesions != NULL){
            require_once __DIR__ . '/../public/View/adhesionGestionView.php';
        }
    }

    public function viewUser(int $id){
        $adhesions = $this->getByUser($id);
        if($adhesions != NULL){
            require_once __DIR__ . '/../public/View/adhesionGestionView.php';
        }
    }
}

?>