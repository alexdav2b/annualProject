<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Saleman.php';

Class SalemanManager{

    public function getAll() : array{
        $api = new ApiManager('Usr');
        $json = $api->getByString('Discriminator', 'Saleman');

        $result = [];
        foreach($json as $line){
            $siteManager = new SiteManager();
            $site = $siteManager->getById(intval($line['SiteID']));
            $user = new Saleman($line['ID'], $line['Email'], $line['Name'], $line['Password'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Eligibility'], $line['Siret'], $site);
            array_push($result, $user);
        }
        return $result;
    }

    public function getById(int $id){
        $api = new ApiManager('Usr');
        $json = $api->getById($id);
        if($json['Discriminator'] != 'Saleman')
            return false;

        $siteManager = new SiteManager();
        $site = $siteManager->getById(intval($json['SiteID']));

        $user = new Saleman($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Eligibility'], $json['Siret'], $site);
        return $user;
    }

    public function getByEmail(string $email){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Email', $email);
        if($json['Discriminator'] != 'Saleman')
            return false;
        $siteManager = new SiteManager();
        $site = $siteManager->getById(intval($json['SiteID']));
        $user = new Saleman($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Eligibility'], $json['Siret'], $site);
        return $user;
    }

    public function gestionViewOne(int $id){
        $user = $this->getById($id);
        if($user != NULL){
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Siret</th>
                <th>Email</th>
                <th>Adresse</th>
                <!-- <th>N°</th>
                <th>Rue</th>
                <th>Postcode</th>
                <th>Area</th> -->
                <th>Eligibility</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th> <?= $user->getName(); ?></th>
                <th> <?= $user->getSiret(); ?></th>
                <th> <?= $user->getEmail(); ?></th>
                <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
                <!-- <th> <?= $user->getNumero(); ?></th>
                <th> <?= $user->getRue(); ?></th>
                <th> <?= $user->getPostcode(); ?></th>
                <th> <?= $user->getArea(); ?></th> -->
                <th> <?= $user->getEligibility(); ?></th>
                <th> <?= $user->getSite()->getName(); ?> </th>
            </tr>
        </tbody>
        <?php
        }
    }

    public function gestionViewAll(){
        $users = $this->getAll();
        if($users != NULL){
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Siret</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Eligibility</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($users as $user){
            ?>
            <tr>
                <th> <?= $user->getName(); ?></th>
                <th> <?= $user->getSiret(); ?></th>
                <th> <?= $user->getEmail(); ?></th>
                <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
                <th> <?= $user->getEligibility() == 1 ? 'Yes' : 'No'; ?></th>
                <th> <?= $user->getSite()->getName(); ?> </th>
            </tr>
            <?php
            }
        ?> </tbody> <?php
        }
    }
}

?>