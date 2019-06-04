<?php

require_once __DIR__ . '/../Models/Stop.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class StopService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new StopService();
        return self::$instance;
    }

    public function create(Stop $Stop): ?Stop{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Stop` (`DateHour`, `DeliveryID`, `UsrDonateId`, `UsrReceiveID`) VALUES(?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $Stop->getDateHour(),
            $Stop->getDeliveryId(),
            $Stop->getDonatorId(),
            $Stop->getReceiverId()
        ]);
        if($affectedRows > 0){
            $Stop->setId($db->LastInsertedId());
            return $Stop;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Stop` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Stop`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $Stop = new Stop(
                    $value['ID'],
                    $value['DateHour'],
                    $value['DeliveryID'],
                    $value['UsrDonateID'],
                    $value['UsrReceiveID']
                );
                array_push($result, $Stop);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Stop{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Stop` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Stop(
                $result['ID'],
                $result['DateHour'],
                $result['DeliveryID'],
                $result['UsrDonateID'],
                $result['UsrReceiveID']
            );
        }
        return NULL;
    }

    public function update(Stop $Stop): ?Stop{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Stop` SET `DateHour` = ?, `DeliveryID` = ?, `UsrDonatorID` = ?, `UsrReceiveID` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Stop->getDateHour(),
            $Stop->getDeliveryId(),
            $Stop->getDonatorId(),
            $Stop->getReceiverId(),
            $Stop->getId()
        ]);
        if($affectedRows > 0){
            return $Stop;
        }
        return NULL;
    }
}

?>