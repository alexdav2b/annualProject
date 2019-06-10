<?php

require_once __DIR__ . '/../Models/Service.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class ServiceService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new ServiceService();
        return self::$instance;
    }

    public function create(Service $Service): ?Service{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Service` (`Name`) VALUES(?)';
        $affectedRows = $db ->exec($sql, [
            $Service->getName()
        ]);
        if($affectedRows > 0){
            $Service->setId($db->LastInsertedId());
            return $Service;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Service` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Service`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $Service = new Service(
                    $value['ID'],
                    $value['Name']
                );
                array_push($result, $Service);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Service{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Service` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Service(
                $result['ID'],
                $result['Name']
            );
        }
        return NULL;
    }

    public function update(Service $Service): ?Service{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Service` SET `Name` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Service->getName(),
            $Service->getId()
        ]);
        if($affectedRows > 0){
            return $Service;
        }
        return NULL;
    }
}

?>