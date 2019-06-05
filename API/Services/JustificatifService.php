<?php

require_once __DIR__ . '/../Models/Justificatif.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class JustificatifService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new JustificatifService();
        return self::$instance;
    }

    public function create(Justificatif $Justificatif): ?Justificatif{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Justificatif` (`Link`, `UsrID`, `CompetenceID`) VALUES(?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $Justificatif->getLink(),
            $Justificatif->getUserId(),
            $Justificatif->getCompetenceId()
        ]);
        if($affectedRows > 0){
            $Justificatif->setId($db->LastInsertedId());
            return $Justificatif;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Justificatif` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Justificatif`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $Justificatif = new Justificatif(
                    $value['ID'],
                    $value['Link'],
                    $value['UsrID'],
                    $value['CompetenceID']
                );
                array_push($result, $Justificatif);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Justificatif{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Justificatif` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Justificatif(
                $result['ID'],
                $result['Link'],
                $result['UsrID'],
                $result['CompetenceID']
            );
        }
        return NULL;
    }

    public function update(Justificatif $Justificatif): ?Justificatif{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Justificatif` SET `Link` = ?, `UsrID` = ?, `CompetenceID` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Justificatif->getLink(),
            $Justificatif->getUserId(),
            $Justificatif->getCompetenceId(),
            $Justificatif->getId()
        ]);
        if($affectedRows > 0){
            return $Justificatif;
        }
        return NULL;
    }
}

?>