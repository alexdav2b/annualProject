<?php

require_once __DIR__ . '/../Models/Depositery.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class DepositeryService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new DepositeryService();
        return self::$instance;
    }

    public function create(Depositery $depositery): ?Depositery{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `DEPOSITERY`(`SiteId`, `Numero`, `Rue`, `Postcode`, `Area`, `Capacity`) VALUES (?, ?, ?, ?, ?, ?)';
        $affectedRows = $db->exec($sql, [
            $depositery->getSiteId(),
            $depositery->getNumero(),
            $depositery->getRue(),
            $depositery->getPostcode(),
            $depositery->getArea(),
            $depositery->getCapacity()
        ]);
        if($affectedRows > 0){
            $depositery->setId($db->LastInsertedId());
            return $depositery;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Depositery` WHERE id = ?';
        $affectedRows = $db->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Depositery`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $depositery = new Depositery(
                    $value['ID'],
                    $value['SiteID'], 
                    $value['Numero'], 
                    $value['Rue'], 
                    $value['Postcode'], 
                    $value['Area'], 
                    $value['Capacity']
                );
                array_push($result, $depositery);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Depositery{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Depositery` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Depositery(
                $result['ID'],
                $result['SiteID'], 
                $result['Numero'], 
                $result['Rue'], 
                $result['Postcode'], 
                $result['Area'], 
                $result['Capacity']
            );
        }
        return NULL;
    }

    public function update(Depositery $depositery): ?Depositery{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Depositery` SET `SiteID` = ?, `Numero` = ?, `Rue` = ?, `Postcode` = ?, `Area` = ?, `Capacity` = ? WHERE id = ?'; //
        $affectedRows = $db ->exec($sql, [
            $depositery->getSiteId(),
            $depositery->getNumero(),
            $depositery->getRue(),
            $depositery->getPostcode(),
            $depositery->getArea(),
            $depositery->getCapacity(),
            $depositery->getId()
        ]);
        if($affectedRows > 0){
            return $depositery;
        }
        return NULL;
    }




}
?>