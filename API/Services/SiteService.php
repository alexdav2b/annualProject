<?php

require_once __DIR__ . '/../Models/Site.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class SiteService {
    // Singleton

	private static $instance;

	private function __construct(){}

	public static function getInstance(){
		if(!isset(self::$instance))
			self::$instance = new SiteService();
		return self::$instance;
	}

    public function create(Site $site): ?Site{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `SITE` (`Name`, `Numero`, `Rue`, `Postcode`, `Area`) VALUES(?, ?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $site->getName(),
            $site->getNumero(),
            $site->getRue(),
            $site->getPostcode(),
            $site->getArea()
        ]);
        if($affectedRows > 0){
            $site->setId($db->LastInsertedId());
            return $site;
        }
        return NULL;
    }

    public static function delete(int $siteId): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `Site` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$siteId]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Site`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach ($array as $value){
                $site = new Site($value['ID'], $value['Name'], $value['Numero'], $value['Rue'], $value['Postcode'], $value['Area']);
                array_push($result, $site);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById(int $siteId): ?Site{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Site` WHERE id = ?';
        $result = $db->getOne($sql, [$siteId]);
        if($result > 0){
            return new Site($result['ID'], $result['Name'], $result['Numero'], $result['Rue'], $result['Postcode'], $result['Area']);
        }
        return NULL;
    }

    public function update(Site $site): ?Site{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `Site` SET `Name` = ?, `Numero` = ?, `Rue` = ?, `Postcode` = ?, `Area` = ? WHERE id = ?'; //
        $affectedRows = $db ->exec($sql, [
            $site->getName(),
            $site->getNumero(),
            $site->getRue(),
            $site->getPostcode(),
            $site->getArea(),
            $site->getId()
        ]);
        if($affectedRows > 0){
            return $site;
        }
        return NULL;
    }
}

?>