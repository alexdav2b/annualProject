<?php

require_once __DIR__ . '/../Models/Competence.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class CompetenceService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new CompetenceService();
        return self::$instance;
    }

    public function create(Competence $competence): ?Competence{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Competence` (`Name`) VALUES(?)';
        $affectedRows = $db ->exec($sql, [
            $competence->getName()
        ]);
        if($affectedRows > 0){
            $competence->setId($db->LastInsertedId());
            return $competence;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `COMPETENCE` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Competence`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $competence = new Competence(
                    $value['ID'],
                    $value['Name']
                );
                array_push($result, $competence);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?Competence{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Competence` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Competence(
                $result['ID'],
                $result['Name']
            );
        }
        return NULL;
    }

    public function update(Competence $Competence): ?Competence{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Competence` SET `Name` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $Competence->getName(),
            $Competence->getId()
        ]);
        if($affectedRows > 0){
            return $Competence;
        }
        return NULL;
    }
}

?>