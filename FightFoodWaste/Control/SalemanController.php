<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Saleman.php';

Class SalemanController{

    // Parse
    private function parseOne($json){
        if($json['Discriminator'] == 'Saleman'){
            $siteManager = new SiteManager();
            $site = $siteManager->getById(intval($json['SiteID']));
            $user = new Saleman($json['ID'], $json['Email'], $json['Name'], $json['Password'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Eligibility'], $json['Siret'], $site);
            return $user;    
        }
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            if($line['Discriminator'] == 'Saleman'){
                $siteController = new SiteController();
                $site = $siteController->getById(intval($line['SiteID']));
                $user = new Saleman($line['ID'], $line['Email'], $line['Name'], $line['Password'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Eligibility'], $line['Siret'], $site);
                array_push($result, $user);
            }
        }
        return $result;
    }

    // GET
    public function getById(int $id){
        $api = new ApiManager('Usr');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Usr');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByEmail(string $email){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Email', $email);
        return $this->parseAll($json);
    }

    public function getByName(string $name){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Name', $email);
        return $this->parseAll($json);
    }

    public function getBySurname(string $surname){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Surname', $surname);
        return $this->parseAll($json);
    }

    public function getByPassword(string $password){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Password', $password);
        return $this->parseAll($json);
    }

    public function getByNumero(string $numero){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Numero', $numero);
        return $this->parseAll($json);
    }

    public function getByRue(string $rue){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Rue', $rue);
        return $this->parseAll($json);
    }

    public function getByPostcode(string $postcode){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Postcode', $postcode);
        return $this->parseAll($json);
    }

    public function getByArea(string $area){
        $api = new ApiManager('Usr');
        $json = $api->getByString('Area', $area);
        return $this->parseAll($json);
    }

    public function getByEligibility(int $eligibility){
        $api = new ApiManager('Usr');
        $json = $api->getByInt('Eligibility', $eligibility);
        return $this->parseAll($json);
    }

    public function getBySite(int $siteId){
        $api = new ApiManager('Usr');
        $json = $api->getByInt('Site', $siteId);
        return $this->parseAll($json);
    }

    public function getBySiret(string $siret){
        $api = new ApiManager('Usr');
        $json = $api->getByInt('Siret', $siret);
        return $this->parseAll($json);
    }

    
    // Views

    // a suppr
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

    public function Inscription(){
        $controller = new SiteController();
        $site = $controller->GetById($_POST['Site']);
        $form = array(
            htmlspecialchars($_POST['Email']),
            htmlspecialchars($_POST['Name']),
            htmlspecialchars($_POST['Password']),
            htmlspecialchars($_POST['Numero']),
            htmlspecialchars($_POST['Rue']),
            htmlspecialchars($_POST['Postcode']),
            htmlspecialchars($_POST['Area']),
            $_POST['Eligibility'], 
            htmlspecialchars($_POST['Siret']), 
            $site
        );
        $user = new Saleman(null, $form[0], $form[1], $form[2], $form[3],  $form[4],  $form[5],  $form[6],  $form[7],  $form[8], $form[9]);
        $user->createIndividual();
        $id = $user->getId();
        header("Location: /compte/$id"); 
    }
}

?>