<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Adhesion.php';
require_once __DIR__ . '/../Model/User.php';

Class AdhesionController{

    // Parse

    private function parseOne($json) : Adhesion{
        $userController = new UserController();
        $user = $userController->getById(intval($json['UsrID']));
        $adhesion = new Adhesion($json['ID'], $json['DateAdhesion'], $user);
        return $adhesion;
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){

            $userController = new UserController();
            $user = $userController->getById(intval($line['UsrID']));

            $adhesion = new Adhesion($line['ID'], $line['DateAdhesion'], $user);
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

    // public function viewAll(){
    //     $adhesions = $this->getAll();
    //     if($adhesions != NULL){
    //         require_once __DIR__ . '/../public/View/adhesionGestionView.php';
    //     }
    // }

    public function Tri($adhesions){
        usort($adhesions, function($a, $b){
            //retourner 0 en cas d'égalité
            if ($a->getDate() == $b->getDate()) {
                return 0;
            } else if ($a->getDate() < $b->getDate()) {//retourner -1 en cas d’infériorité
                return -1;
            } else {//retourner 1 en cas de supériorité
                return 1;
            }
        });
    }

    public function viewUser(int $id){
        if(!isset($_SESSION['User']) || $_SESSION['User'] != 'Saleman' && $_SESSION['Id'] != $id){
            header('Location: /404');
        }

        $all = $this->getByUser($id);

        $adhesions = array();
        $count = count($all);

        
        foreach($all as $adhesion){
            if($adhesion->getUser()->getId() == $id){
                array_push($adhesions, $adhesion);
            }
        }
        $btn;
        $last;
        if($adhesions != null && count($adhesions) != 1){
            $this->Tri($adhesions);
            $last = end($all); 
            $last = new DateTime($last->getDate());
        }else{
            $last = $adhesions[0]->getDate();
            $last = new DateTime($last);
        }
        $now = new DateTime();
        
        $year = clone $last;
        $month =  clone $last;
        $date = clone $last; 

        $year->add(new DateInterval('P1Y'));
        $month->add(new DateInterval('P11M'));

        if($month <= $now){
            $btn = true;
            $dateToPost = $year;
        }else if($year <= $now){
            $btn = true;
            $dateToPost = $now;
        }else{
            $btn = false;
        }
        require_once __DIR__ . '/../public/View/adhesionView.php';
    }

    public function Invoice(int $id){
        $adhesion = $this->getById($id);
        if($adhesion == null || !isset($_SESSION['User']) || $_SESSION['User'] != 'Saleman' && $_SESSION['Id'] != $adhesion->getUser()->getId()){
            header('Location: /404');
        }
        $userN = $adhesion->getUser()->getNumero();
        $userR = $adhesion->getUser()->getRue();
        $userP = $adhesion->getUser()->getPostcode();
        $userA = $adhesion->getUser()->getArea();

        $siteN = $adhesion->getUser()->getSite()->getNumero();
        $siteR = $adhesion->getUser()->getSite()->getRue();
        $siteP = $adhesion->getUser()->getSite()->getPostcode();
        $siteA = $adhesion->getUser()->getSite()->getArea();

        $name = $adhesion->getUser()->getName();
        $date = $adhesion->getDate();
        $prix = 100;

        $lastDay = date('d/m/Y', strtotime($date . '+1 year'));
        $date = date('d/m/Y', strtotime($date));
        
        require_once __DIR__ . '/../public/View/AdhesionPDF.php';
    }

    public function Add(){
        if(!isset($_SESSION['User']) || $_SESSION['User'] != 'Saleman' || !isset($_SESSION['Id'])){
            header('Location: /404');
        }

        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');

        $controller = new UserController();
        $user = $controller->getById($_SESSION['Id']);
        $idUser = $_SESSION['Id'];

        $form = array(
            $now,
            $user
        );
        $adhesion = new Adhesion(null, $form[0], $form[1]);
        $adhesion->create();        
        $id = $adhesion->getId();

        http_response_code(201);
        echo (json_encode($adhesion));
    }

    // public function New(){
    //     if(!isset($_SESSION['User']) || $_SESSION['User'] != 'Saleman'){
    //         header('Location: /404');
    //     }
    //     require_once __DIR__ . '/../public/View/newAdhesionView.php';
    // }

    public function ViewNew(){

    }
}

?>