<?php

require_once __DIR__ . '/../Models/StopProduct.php';
require_once __DIR__ . '/../Utils/DatabaseManager.php';

class StopProductService{
    // Singleton

    private static $instance;

    private function __construct(){}

    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new StopProductService();
        return self::$instance;
    }

    public function create(StopProduct $StopProduct): ?StopProduct{
        $db = DatabaseManager::getManager();
        $sql = 'INSERT INTO `Stop_Product` (`StopID`, `ProductID`) VALUES(?, ?)';
        $affectedRows = $db ->exec($sql, [
            $StopProduct->getStopId(),
            $StopProduct->getProductID()
        ]);
        if($affectedRows > 0){
            return $StopProduct;
        }
        return NULL;
    }

    public static function delete(int $stopId, ?int $productId): bool{
        $db = DatabaseManager::getManager();
        if($productId == null){
            $sql = 'DELETE FROM `StopProduct` WHERE `StopID` = ?';
            $affectedRows = $db ->exec($sql, [$stopId]);
        }else{
            $sql = 'DELETE FROM `StopProduct` WHERE `StopID` = ? AND `ProductID` = ?';
            $affectedRows = $db ->exec($sql, [
                $stopId,
                $productId
            ]);
        }
        if($affectedRows > 0){
            return true;
        }
        return false;
    }

    public static function getAll(): array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Stop_Product`';
        $array = $db->getAll($sql);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $StopProduct = new StopProduct(
                    $value['StopID'],
                    $value['ProductID']
                );
                array_push($result, $StopProduct);
            }
            return $result;
        }
        return NULL;
    }

    public static function getAllByProductId(int $productId): ?array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Stop_Product` WHERE productId = ?';
        $array = $db->getAll($sql, [$productId]);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $StopProduct = new StopProduct(
                    $value['StopID'],
                    $value['ProductID']
                );
                array_push($result, $StopProduct);
            }
            return $result;
        }
        return NULL;
    }

    public static function getAllByStopId(int $stopId): ?array{
        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM `Stop_Product` WHERE stopId = ?';
        $array = $db->getAll($sql, [$stopId]);
        $result;
        if(count($array) > 0){
            $result = array();
            foreach($array as $value){
                $StopProduct = new StopProduct(
                    $value['StopID'],
                    $value['ProductID']
                );
                array_push($result, $StopProduct);
            }
            return $result;
        }
        return NULL;
    }

    // public function update(StopProduct $StopProduct): ?StopProduct{
    //     $db = DatabaseManager::getManager();
    //     $sql = 'UPDATE `Stop_Product` SET  `StopID` = ?, `ProductID` = ? WHERE id = ?';
    //     $affectedRows = $db ->exec($sql, [
    //         $StopProduct->getStopId(),
    //         $StopProduct->getProductId()
    //     ]);
    //     if($affectedRows > 0){
    //         return $StopProduct;
    //     }
    //     return NULL;
    // }
}

?>
