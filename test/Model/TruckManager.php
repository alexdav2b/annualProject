<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Truck.php';

Class TruckManager{

    public function getAll() : array{
        $api = new ApiManager('Truck');
        $json = $api->getAll();
        if($json == NULL ||$json == false){
            return false;
        }
        $result = [];
        foreach($json as $line){

            $siteManager = new SiteManager();
            $site = $siteManager->getById(intval($line['SiteID']));

            $object = new Truck($line['ID'], $line['Plate'], $line['Name'], $line['Capacity'], $site);
            array_push($result, $object);
        }
        return $result;
    }

    public function getById(int $id){
        $api = new ApiManager('Truck');
        $line = $api->getById($id);
        if($line == NULL ||$line == false){
            return false;
        }

        $siteManager = new SiteManager();
        $site = $siteManager->getById(intval($line['SiteID']));
        $object = new Truck($line['ID'], $line['Plate'], $line['Name'], $line['Capacity'], $site);
        return $object;
    }

    public function getBySite(Site $site){
        $api = new ApiManager('Truck');
        $json = $api->getByInt('SiteID', $site->getId());
        if($json == NULL || $json == false){
            return NULL;
        }

        $result = [];
        foreach($json as $line){
            if($site->getId() != $line['SiteID'])
                return NULL;
            $object = new Truck($line['ID'], $line['Plate'], $line['Name'], $line['Capacity'], $site);
            array_push($result, $object);
        }
        return $result;
    }

    public function gestionViewOne(int $id){
        $object = $this->getById($id);
        if($object != NULL){
            $site = $object->getSite();
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Plate</th>
                <th>Capacity (Products)</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th> <?= $object->getName(); ?></th>
                <th> <?= $object->getPlate(); ?></th>
                <th> <?= $object->getCapacity(); ?></th>
                <th> <?= $site->getName(); ?> </th>
                <th> <?= $site->getNumero() . ', ' .  $site->getRue() . ' ' . $site->getPostcode() . ' ' . $site->getArea() ?> </th>
            </tr>
        </tbody>
        <?php
        }
    }

    public function gestionViewAll(){
        $objects = $this->getAll();
        if($objects != NULl){
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Plate</th>
                <th>Capacity (Products)</th>
                <th>Site</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($objects as $object){
                $site = $object->getSite();
                ?>
            <tr>
                <th> <?= $object->getName(); ?></th>
                <th> <?= $object->getPlate(); ?></th>
                <th> <?= $object->getCapacity(); ?></th>
                <th> <?= $site->getName(); ?> </th>
                <th> <?= $site->getNumero() . ', ' .  $site->getRue() . ' ' . $site->getPostcode() . ' ' . $site->getArea() ?> </th>
            </tr>
            <?php } ?>
        </tbody> 
        <?php }
    }

    public function gestionViewBySite(Site $site){
        $objects = $this->getBySite($site);
        if($objects != NULl){ ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Plate</th>
                <th>Capacity (Products)</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($objects as $object){
                $site = $object->getSite();
                ?>
            <tr>
                <th> <?= $object->getName(); ?></th>
                <th> <?= $object->getPlate(); ?></th>
                <th> <?= $object->getCapacity(); ?></th>
                <th> <?= $site->getName(); ?> </th>
                <th> <?= $site->getNumero() . ', ' .  $site->getRue() . ' ' . $site->getPostcode() . ' ' . $site->getArea() ?> </th>
            </tr>
            <?php } ?>
        </tbody> 
    <?php }
    }
}