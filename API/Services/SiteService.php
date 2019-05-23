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

    public function insert(Site $site): ?Site{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `SITE` (`Name`,`Address`) VALUES(?, ?)';
        $affectedRows = $db ->exec($sql, [
            $site->getName(),
            $site->getAddress(),
        ]);
        if($affectedRows > 0){
            $site->setId($db->LastInsertedId());
            return $site;
        }
        return NULL;
    }
}

?>