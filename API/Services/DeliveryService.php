<?php

require_once __DIR__ . '/../Models/Delivery.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class DeliveryService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new DeliveryService();
        return self::$instance;
    }

    public function create(Delivery $Delivery): ?Delivery{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Delivery` (`TruckID`, `UsrID`, `DeliveryTypeID`, `DateStart`, `DateEnd`) VALUES(?, ?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $Delivery->getTruckId(),
            $Delivery->getUserId(),
            $Delivery->getDeliveryTypeId(),
            $Delivery->getDateStart(),
            $Delivery->getDateEnd()
        ]);
        if($affectedRows > 0){
            $Delivery->setId($db->LastInsertedId());
            return $Delivery;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Delivery` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Delivery`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $Delivery = new Delivery(
                    $value['ID'],
                    $value['Name']
                );
                array_push($result, $Delivery);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Delivery{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Delivery` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Delivery(
                $result['ID'],
                $result['Name']
            );
        }
        return NULL;
    }

    public function update(Delivery $Delivery): ?Delivery{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Delivery` SET `Name` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Delivery->getName(),
            $Delivery->getId()
        ]);
        if($affectedRows > 0){
            return $Delivery;
        }
        return NULL;
    }
}

?>