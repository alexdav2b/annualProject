<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Site.php';

Class SiteManager{

    public function getAll() : array{
        $api = new ApiManager('Site');
        $json = $api->getAll();

        $result = [];
        foreach($json as $line){
            $object = new Site($line['ID'], $line['Name'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area']);
            array_push($result, $object);
        }
        return $result;
    }

    public function getById(int $id){
        $api = new ApiManager('Site');
        $json = $api->getById($id);
        return new Site($json['ID'], $json['Name'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area']);
    }

    public function gestionViewAll(){
        $sites = $this->getAll();
        if($sites != NULL){
        ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>N°</th>
                <th>Rue</th>
                <th>Postcode</th>
                <th>Area</th>
            </tr>
        </thead>
        <tbody>

        <?php

            foreach ($sites as $site){
            ?>
            <tr>
                <th> <?= $site->getName(); ?></th>
                <th> <?= $site->getNumero(); ?></th>
                <th> <?= $site->getRue(); ?></th>
                <th> <?= $site->getPostcode(); ?></th>
                <th> <?= $site->getArea(); ?></th>
            </tr>
            <?php
            }
        ?> </tbody> <?php
        }   
    }
}

?>