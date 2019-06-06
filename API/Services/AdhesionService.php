<?php

require_once __DIR__ . '/../Models/Adhesion.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class AdhesionService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new AdhesionService();
        return self::$instance;
    }

    public function create(Adhesion $Adhesion): ?Adhesion{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Adhesion` (`UsrId`, `DateAdhesion`, `Cb`, `Code`) VALUES(?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $Adhesion->getUserId(),
            $Adhesion->getDateAdhesion(),
            $Adhesion->getCb(),
            $Adhesion->getCode()
        ]);
        if($affectedRows > 0){
            $Adhesion->setId($db->LastInsertedId());
            return $Adhesion;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Adhesion` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Adhesion`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $Adhesion = new Adhesion(
                    $value['ID'],
                    $value['UsrID'],
                    $value['DateAdhesion'],
                    $value['Cb'],
                    $value['Code']
                );
                array_push($result, $Adhesion);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Adhesion{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Adhesion` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Adhesion(
                $result['ID'],
                $result['UsrID'],
                $result['DateAdhesion'],
                $result['Cb'],
                $result['Code']
            );
        }
        return NULL;
    }

    public function update(Adhesion $Adhesion): ?Adhesion{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Adhesion` SET `UsrId` = ?, `DateAdhesion` = ?, `Cb` = ?, `Code` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Adhesion->getUserId(),
            $Adhesion->getDateAdhesion(),
            $Adhesion->getCb(),
            $Adhesion->getCode(),
            $Adhesion->getId()
        ]);
        if($affectedRows > 0){
            return $Adhesion;
        }
        return NULL;
    }
}

?>