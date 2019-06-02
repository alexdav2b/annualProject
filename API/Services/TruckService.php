<?php

require_once __DIR__ . '/../Models/Truck.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class TruckService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new TruckService();
        return self::$instance;
    }

    public function create(Truck $truck): ?Truck{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `TRUCK` (`SiteId`, `Plate`, `Name`, `Capacity`) VALUES(?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $truck->getSiteId(),
            $truck->getPlate(),
            $truck->getName(),
            $truck->getCapacity()
        ]);
        if($affectedRows > 0){
            $truck->setId($db->LastInsertedId());
            return $truck;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Truck` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Truck`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach ($array as $value){
                $truck = new Truck($value['ID'], $value['SiteID'], $value['Plate'], $value['Name'], $value['Capacity']);
                array_push($result, $truck);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById(int $id): ?Truck{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Truck` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Truck($result['ID'], $result['SiteID'], $result['Plate'], $result['Name'], $result['Capacity']);
        }
        return NULL;
    }

    public function update(truck $truck): ?Truck{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `TRUCK` SET `SiteID` = ?, `Plate` = ?, `Name` = ?, `Capacity` = ? WHERE id = ?'; 
        $affectedRows = $db ->exec($sql, [
            $truck->getSiteId(),
            $truck->getPlate(),
            $truck->getName(),
            $truck->getCapacity(),
            $truck->getId()
        ]);
        if($affectedRows > 0){
            return $truck;
        }
        return NULL;
    }
}

?>