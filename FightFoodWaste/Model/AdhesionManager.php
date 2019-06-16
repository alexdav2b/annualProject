<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Adhesion.php';
require_once __DIR__ . '/../Model/User.php';

Class AdhesionManager{

    public function getAll() : array{
        $api = new ApiManager('Adhesion');
        $json = $api->getAll();
        if($json == NULL || $json == false)
            return false;

        $result = [];
        foreach($json as $line){

            $userManager = new UserManager();
            $user = $userManager->getById(intval($line['UsrID']));

            $adhesion = new Adhesion($line['ID'], $line['DateAdhesion'], $line['Cb'], $line['Code'], $user);
            array_push($result, $adhesion);
        }
        return $result;
    }

    public function getById(int $id){
        $api = new ApiManager('Adhesion');
        $line = $api->getById($id);
        if($line == NULL || $line == false)
            return false;

        $userManager = new UserManager();
        $user = $userManager->getById(intval($line['UsrID']));

        $adhesion = new Adhesion($line['ID'], $line['DateAdhesion'], $line['Cb'], $line['Code'], $user);
        return $adhesion;
    }

    public function getByUser(User $user){
        $api = new ApiManager('Adhesion');
  
        $json = $api->getByInt('UsrID', $user->getId());

        if($json == NULL || $json == false){
            return false;
        }

        $result = [];
        foreach($json as $line){
            $adhesion = new Adhesion($line['ID'], $line['DateAdhesion'], $line['Cb'], $line['Code'], $user);
            array_push($result, $adhesion);
        }
        return $result;
    }

    public function gestionViewOne(int $id){
        $adhesion = $this->getById($id)
        ?>
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>Débiteur</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>
            </tr>
        </tbody>
        <?php
    }

    public function gestionViewAll(){
        $adhesions = $this->getAll();
        if($adhesions != NULL){
        ?>
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>Débiteur</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($adhesions as $adhesion){
            ?>
            <tr>
                <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>
            </tr>
            <?php
            }
        ?> </tbody> <?php
        }
    }

    public function gestionViewByUser(User $user){
        $adhesions = $this->getByUser($user);
        if($adhesions != NULL){
        ?>
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>Débiteur</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($adhesions as $adhesion){
            ?>
            <tr>
                <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>
            </tr>
            <?php
            }
        ?> </tbody> <?php
        }
    }
}

?>