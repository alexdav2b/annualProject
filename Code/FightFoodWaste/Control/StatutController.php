<?php

require_once __DIR__ . '/../Model/ApiManager.php';
require_once __DIR__ . '/../Model/Statut.php';

Class StatutController{

    // Parse
    private function parseOne($json) : Stop{
        return new Statut($json['ID'], $json['Name']);
    }

    private function parseAll($json) : array{
        $result = [];
        foreach($json as $line){
            $statut = new Statut($line['ID'], $line['Name']);
            array_push($result, $statut);
        }
        return $result;
    }

    // Get
    public function getById(int $id){
        $api = new ApiManager('Statut');
        $json = $api->getById($id);
        return $this->parseOne($json);
    }

    public function getAll() : array{
        $api = new ApiManager('Statut');
        $json = $api->getAll();
        return $this->parseAll($json);
    }

    public function getByName(string $name) : array{
        $api = new ApiManager('Statut');
        $json = $api->getByString('Name', $name);
        return $this->parseAll($json);
    }

    // Views
}

?>