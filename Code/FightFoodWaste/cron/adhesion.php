<?php

require_once __DIR__ . '/../Model/Mail.php';
require_once __DIR__ . '/../Control/AdhesionController.php';
require_once __DIR__ . '/../Control/UserController.php';

$adhesionC = new AdhesionController();

$adhesions = $adhesionC->getAll();

$users  = array();

foreach($adhesions as $adhesion){
    $user = $adhesion->getUser()->getId();
    $users[$user][] = $adhesion->getDate();
}

foreach($users as $adhesionA){
    if(count($adhesionA) != 1){

        $last = end($adhesionA); 
        $last = new DateTime($last);
    }else{
        $last = $adhesionA[0];
        $last = new DateTime($last);
    }
    $now = new DateTime();
    
    $year = clone $last;
    $month =  clone $last;
    $date = clone $last; 

    $year->add(new DateInterval('P1Y'));

    $month->add(new DateInterval('P11M'));
    
    if($month <= $now || $year <= $now){
        $userC  = new UserController();
        $user = $userC->getById($user);
        $mail = new Mail($user->getEmail(), MAIL, 'Renouveler votre adhesion');
        $mail->generateBody('Adhesion', $user);
        $mail->Send('Simple');
    }
}
?>