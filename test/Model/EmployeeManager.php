<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Employee.php';

Class EmployeeManager{

    public function getAll() : array{
        $api = new ApiManager('Usr');
        $json = $api->getByString('Discriminator', 'Employer');

        $result = [];
        foreach($json as $line){
            $siteManager = new SiteManager();
            $site = $siteManager->getById(intval($line['SiteID']));
            $user = new Employee($line['ID'], $line['Email'], $line['Name'], $line['Password'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Eligibility'], $line['Salary'], $line['Surname'], $site);
            array_push($result, $user);
        }
        return $result;
    }

    public function getById(int $id){
        $api = new ApiManager('Usr');
        $json = $api->getById($id);
        if($json['Discriminator'] != 'Employer')
            return false;

        $siteManager = new SiteManager();
        $site = $siteManager->getById(intval($json['SiteID']));

        $user = new Employee($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Eligibility'], $json['Salary'], $json['Surname'], $site);
        return $user;
    }

    public function getByEmail(string $email){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Email', $email);
        if($json['Discriminator'] != 'Employer')
            return false;
        $siteManager = new SiteManager();
        $site = $siteManager->getById(intval($json['SiteID']));
        $user = new Employee($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Eligibility'], $json['Salary'], $json['Surname'], $site);
        return $user;
    }

    public function gestionViewOne(int $id){
        $user = $this->getById($id);
        if($user != NULL){
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Eligibility</th>
                <th>Salary</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th> <?= $user->getName(); ?></th>
                <th> <?= $user->getSurname(); ?></th>
                <th> <?= $user->getEmail(); ?></th>
                <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
                <th> <?= $user->getEligibility(); ?></th>
                <th> <?= $user->getSalary() . ' €';?></tH>
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
                <th>Surname</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Eligibility</th>
                <th>Salary</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>

        <?php
            foreach ($users as $user){
            ?>
            <tr>
                <th> <?= $user->getName(); ?></th>
                <th> <?= $user->getSurname(); ?></th>
                <th> <?= $user->getEmail(); ?></th>
                <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
                <th> <?= $user->getEligibility() == 1 ? 'Yes' : 'No'; ?></th>
                <th> <?= $user->getSalary() . ' €';?></th>
                <th> <?= $user->getSite()->getName(); ?> </th>
            </tr>
            <?php
            }
        ?> </tbody> <?php
        }
    }
}

?>