<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class UserService {
    // Singleton

	private static $instance;

	private function __construct(){}

	public static function getInstance(){
		if(!isset(self::$instance))
			self::$instance = new UserService();
		return self::$instance;
	}

    public function insert(User $user): ?User{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO USR (`Surname`, `Name`, `Eligibility`, `Discriminator`) VALUES(?, ?, ?,?)';
        $affectedRows = $db ->exec($sql, [
            $user->getSurname(),
            $user->getName(),
            $user->getEligibility(),
            'User'
        ]);
        if($affectedRows > 0){
            $user->setId($db->LastInsertedId());
            return $user;
        }
        return NULL;
    }
}

?>