<?php

require_once __DIR__ . '/../Models/DeliveryType.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class DeliveryTypeService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new DeliveryTypeService();
        return self::$instance;
    }

    public function create(DeliveryType $DeliveryType): ?DeliveryType{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `DeliveryType` (`Name`) VALUES(?)';
        $affectedRows = $db ->exec($sql, [
            $DeliveryType->getName()
        ]);
        if($affectedRows > 0){
            $DeliveryType->setId($db->LastInsertedId());
            return $DeliveryType;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `DeliveryType` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `DeliveryType`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $DeliveryType = new DeliveryType(
                    $value['ID'],
                    $value['Name']
                );
                array_push($result, $DeliveryType);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?DeliveryType{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `DeliveryType` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new DeliveryType(
                $result['ID'],
                $result['Name']
            );
        }
        return NULL;
    }

    public function update(DeliveryType $DeliveryType): ?DeliveryType{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `DeliveryType` SET `Name` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $DeliveryType->getName(),
            $DeliveryType->getId()
        ]);
        if($affectedRows > 0){
            return $DeliveryType;
        }
        return NULL;
    }
}

?>