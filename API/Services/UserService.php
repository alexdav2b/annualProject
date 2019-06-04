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

    public function create(User $user): ?User{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO USR (
            `SiteID`,
            `ServiceID`,
            `Email`,
            `Name`,
            `Surname`,
            `Password`,
            `Numero`,
            `Rue`,
            `Postcode`,
            `Area`,
            `Eligibility`,
            `Siret`,
            `Salary`,
            `Discriminator`) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $user->getSiteId(),
            $user->getServiceId(),
            $user->getEmail(),
            $user->getName(),
            $user->getSurname(),
            $user->getPassword(),
            $user->getNumero(),
            $user->getRue(),
            $user->getPostcode(),
            $user->getArea(),
            $user->getEligibility(),
            $user->getSiret(),
            $user->getSalary(),
            $user->getDiscriminator()
        ]);
        if($affectedRows > 0){
            $user->setId($db->LastInsertedId());
            return $user;
        }
        return NULL;
    }

    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `USR` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `USR`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $user = new User(
                    $value['ID'],
                    $value['SiteID'],
                    $value['ServiceID'],
                    $value['Email'],
                    $value['Name'],
                    $value['Surname'],
                    $value['Password'],
                    $value['Numero'],
                    $value['Rue'],
                    $value['Postcode'],
                    $value['Area'],
                    $value['Eligibility'],
                    $value['Siret'],
                    $value['Salary'],
                    $value['Discriminator']
                );
                array_push($result, $user);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById($id): ?User{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `USR` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new User(
                $result['ID'],
                $result['SiteID'],
                $result['ServiceID'],
                $result['Email'],
                $result['Name'],
                $result['Surname'],
                $result['Password'],
                $result['Numero'],
                $result['Rue'],
                $result['Postcode'],
                $result['Area'],
                $result['Eligibility'],
                $result['Siret'],
                $result['Salary'],
                $result['Discriminator']
            );
        }
        return NULL;
    }

    public function update(User $user): ?User{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `USR` SET `SiteID` = ?, `ServiceID` = ?, `Email` = ?, `Name` = ?, `Surname` = ?, 
        `Password` = ?, `Numero` = ?, `Rue` = ?, `Postcode` = ?, `Area` = ?, `Eligibility` = ?,
        `Siret` = ?, `Salary` = ?, `Discriminator` = ? WHERE id = ?';
        $affectedRows = $db ->exec($sql, [
            $user->getSiteId(),
            $user->getServiceId(),
            $user->getEmail(),
            $user->getName(),
            $user->getSurname(),
            $user->getPassword(),
            $user->getNumero(),
            $user->getRue(),
            $user->getPostcode(),
            $user->getArea(),
            $user->getEligibility(),
            $user->getSiret(),
            $user->getSalary(),
            $user->getDiscriminator(),
            $user->getId()
        ]);
        if($affectedRows > 0){
            return $user;
        }
        return NULL;
    }
}

?>