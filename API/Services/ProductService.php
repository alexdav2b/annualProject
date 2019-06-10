<?php

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class ProductService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new ProductService();
        return self::$instance;
    }

    // A verifier avec BDD
    public function create(Product $product): ?Product{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `PRODUCT` (`DepositeryID`, `Name`, `Barcode`, `ValidDate`) VALUES(?, ?, ?, ?)';
        $affectedRows = $db ->exec($sql, [
            $product->getDepositeryId(),
            $product->getName(),
            $product->getBarcode(),
            $product->getValidDate()
        ]);
        if($affectedRows > 0){
            $product->setId($db->LastInsertedId());
            return $product;
        }
        return NULL;
    }

    // a verifier
    public static function delete(int $id): bool{
        $db = DatabaseManager::getManager();
        $sql = 'DELETE FROM `PRODUCT` WHERE id = ?';
        $affectedRows = $db ->exec($sql, [$id]);
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `PRODUCT`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach ($array as $value){
                $product = new Product($value['ID'], $value['DepositeryID'], $value['Name'], $value['Barcode'], $value['ValidDate']);
                array_push($result, $product);
            }
            return $result;
        }
        return NULL;
    }

    public static function getById(int $id): ?Product{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `PRODUCT` WHERE id = ?';
        $result = $db->getOne($sql, [$id]);
        if($result > 0){
            return new Product($result['ID'], $result['DepositeryID'], $result['Name'], $result['Barcode'], $result['ValidDate']);
        }
        return NULL;
    }

    public function update(Product $product): ?Product{
        $db = DatabaseManager::getManager();
        $sql = 'UPDATE `PRODUCT` SET `DepositeryID` = ?, `Name` = ?, `Barcode` = ?, `ValidDate` = ? WHERE id = ?'; 
        $affectedRows = $db ->exec($sql, [
            $product->getDepositeryId(),
            $product->getName(),
            $product->getBarcode(),
            $product->getValidDate(),
            $product->getId()
        ]);
        if($affectedRows > 0){
            return $product;
        }
        return NULL;
    }
}

?>