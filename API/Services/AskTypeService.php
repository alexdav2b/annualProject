<?php

require_once __DIR__ . '/../Models/AskType.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class AskTypeService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new AskTypeService();
        return self::$instance;
    }

    public function create(AskType $askType): ?AskType{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `ASKTYPE`(`Name`) VALUES (?)';
        $affectedRows = $db->exec($sql, [
            $askType->getName()
        ]);
        if($affectedRows > 0){
            $askType->setId($db->LastInsertedId());
            return $askType;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `ASKTYPE` WHERE id = ?';
        $affectedRows = $db->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `ASKTYPE`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $askType = new AskType(
                    $value['ID'],
                    $value['Name']
                );
                array_push($result, $askType);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?AskType{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `ASKTYPE` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new AskType(
                $result['ID'],
                $result['Name']
            );
        }
        return NULL;
    }

    public function update(AskType $askType): ?AskType{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `ASKTYPE` SET `Name` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $askType->getName(),
            $askType->getId()
        ]);
        if($affectedRows > 0){
            return $askType;
        }
        return NULL;
    }

}
?>