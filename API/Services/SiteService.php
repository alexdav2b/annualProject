<?php

require_once __DIR__ . '/../../Models/Site.php';
require_once __DIR__ . '/../../Utils/DatabaseManager.php';

class SiteService {
    // Singleton

	private static $instance;

	private function __construct(){}

	public static function getInstance(){
		if(!isset(self::$instance))
			self::$instance = new SiteService();
		return self::$instance;
	}

    public function insert(User $user): ?User{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO USR (`Name`,`Address`) VALUES(?, ?)';
        $affectedRows = $db ->exec($sql, [
            $user->getName(),
            $user->getAddress(),
            $user->getEligibility(),
        ]);
        if($affectedRows > 0){
            $user->setId($db->LastInsertedId());
            return $user;
        }
        return NULL;
    }
}

?>