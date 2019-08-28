<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Utils\DatabaseManager;

class PagesController{

    protected $container;

    public function __construct($container){

        $this->container = $container;
    }

    public function create(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");
        $json = $request->getBody(); 
        $data = json_decode($json, true);
        $db = DatabaseManager::getManager();
        $sql = $db->getSQLCreate($args['table'], $data);
        if($sql == 'error'){
            return $response->withStatus(400);
        }
        
        $values = [];
        array_push($values, NULL);
        $array = array_values($data);
        foreach($array as $value)
            array_push($values, $value);

        $result = $db->exec($sql, $values);
        if($result > 0){
            $array = array('ID' =>$db->LastInsertedId());
            foreach($data as $key =>$value){
                $array[$key] = $value;
            }
            echo json_encode($array);
            return $response->withStatus(201);
        }
        echo NULL;
        return $response->withStatus(400);
    }

    public function update(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");
        $json = $request->getBody(); 
        $data = json_decode($json, true);

        $db = DatabaseManager::getManager();

        $sqlRes = $db->getSQLUpdate($args['table'], $data);
        if($sqlRes == 'error' || $sqlRes == NULL){
            return $response->withStatus(400);
        }
        
        $sql = $sqlRes[0];
        $values = $sqlRes[1];

        $result = $db->exec($sql, $values);
        if($result > 0){
            echo json_encode($data);
            return $response->withStatus(201);
        }
        return $response->withStatus(400);
    }

    public function getById(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");

        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM '. $args['table'].' WHERE ID = ?';

        $id = array(intval($args['id']));
        $result = $db->getOne($sql, $id);
        if($result > 0){
            echo json_encode($result);
            return $response->withStatus(201);
        }
        return $response->withStatus(400);
    }

    public function getByInt(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");
        if($args['column'] == 'ID' || $args['column'] == 'Id' || $args['column'] == 'id' || $args['column'] == 'iD'){
            return $response->withStatus(400);
        }

        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM '. $args['table'].' WHERE ' . $args['column'] .' = ?';

        $value = array(intval($args['value']));

        $result = $db->getAll($sql, $value);
        if($result > 0){
            echo json_encode($result);
            return $response->withStatus(201);
        }
        return $response->withStatus(400);
    }

    public function getByString(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");

        $db = DatabaseManager::getManager();
        $sql = 'SELECT * FROM '. $args['table'].' WHERE ' . $args['column'] .' = ?';

        $value = array($args['value']);
        $result = $db->getAll($sql, $value);
        if($result > 0){
            echo json_encode($result);
            return $response->withStatus(201);
        }
        return $response->withStatus(400);
    }

    public function getAll(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");

        $db = DatabaseManager::getManager();

        $sql = $db->getSQLAll($args['table']);
        if($sql == 'error'){
            return $response->withStatus(400);
        }

        $result = $db->getAll($sql);
        if($result > 0){
            echo json_encode($result);
            return $response->withStatus(201);
        }
        echo NULL;
        return $response->withStatus(400);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, $args){
        header("Content-Type: application/json");

        $db = DatabaseManager::getManager();

        $sql = $db->getSQLDelete($args['table']);
        if($sql == 'error'){
            return $response->withStatus(400);
        }

        $result = $db->exec($sql, [$args['id']]);
        $success = array('Success' => true);
        $error = array('Success' => false);
        if($result > 0){
            echo json_encode($success);
            return $response->withStatus(201);
        }
        return $response->withStatus(400);
        echo json_encode($error);
    }
}

?>