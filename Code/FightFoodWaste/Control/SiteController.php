<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Site.php';

Class SiteController{

    // Parse
    private function parseOne($json) : Site{
        return new Site($json['ID'], $json['Name'], $json['Numero'], $json['Rue'], $json['Postcode'], $json['Area'], $json['Capacity']);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $object = new Site($line['ID'], $line['Name'], $line['Numero'], $line['Rue'], $line['Postcode'], $line['Area'], $line['Capacity']);
            array_push($result, $object);
        }
        return $result;
    }

    // GET
    public function getAll() : array{
        $api = new ApiManager('Site');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getById(int $id){
        $api = new ApiManager('Site');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getByName(string $name){
        $api = new ApiManager('Site');
        $json = $api->getByString('Name', $name);
        return $this->parseOne($json);
    }

    public function getByCapacity(int $number){
        $api = new ApiManager('Site');
        $json = $api->getByString('Capacity', $number);
        return $this->parseOne($json);
    }

    // Views
    public function viewAll(){
        $sites = $this->getAll();
        if($sites != NULL){
            require_once __DIR__ . '/../public/View/siteGestionView.php';
        }
    }

    public function view(int $id){
        $site = $this->getById($id);
        $productC = new ProductController();
        $depotC = new DepositeryController();
        $depots = $depotC->getBySite($id);
        $res = array();

        $statutC = new StatutController();
        $statuts = $statutC->getAll();
        foreach($depots as $depot){
            $products = $productC->getByDepositery($depot->getId());
            foreach($products as $product){
                array_push($res, $product);
            }
        }
        if($site != NULL){
            require_once __DIR__ . '/../public/View/productsView.php';
            // require_once __DIR__ . '/../public/View/siteGestionView.php';
        }
    }
}

?>