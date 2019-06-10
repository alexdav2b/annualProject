<?php

require_once __DIR__ . '/../Control/User/User.php';
require_once __DIR__ . '/../utils/DatabaseManager.php';
Class UserModel{
    private static $instance;

    private function __construct(){}

    public static function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new UserModel();
        }
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
$u1 = new User(1, 'soso94169@hotmail.fr', 'sophie', 'pelluet', 'lampe', '94 Chaus�e de l Etang 94160 Stmand�', true);
$new = UserModel::getInstance()->insert($u1);
echo $new;
?>