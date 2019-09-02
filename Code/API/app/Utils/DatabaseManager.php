<?php

namespace App\Utils;
use PDO;
use PDOStatement;
use DateTime;

require_once __DIR__ . '/.conf.php';

class DatabaseManager {
	private $pdo;

	 // 1.
	private static $manager;

	 // 2.
	private function __construct(){
        // $conn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
		$conn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME ;
        $this->pdo = new PDO($conn, DB_USER, DB_PWD);
	}

	// 3.
	public static function getManager(): DatabaseManager{ 
		if(!isset(self::$manager)){
			self::$manager = new DatabaseManager();
		}
		return self::$manager;
	}

	private function internalExec(string $sql, array $params = []): ?PDOStatement {
		$stmt = $this->pdo->prepare($sql);
		if($stmt !== false){
			$success = $stmt->execute($params);
			if($success !== false){
				return $stmt;
			}
			if(DB_LOG){
				print_r($stmt->errorInfo());
			}
		}
		return NULL;
	}

	public function exec(string $sql, array $params = []): int{
		$stmt = $this->internalExec($sql, $params);
		return $stmt !== NULL ? $stmt->rowCount() : 0;
	}

	public function getAll(string $sql, array $params = []): array{
		$stmt = $this->internalExec($sql, $params);
		return $stmt !== NULL ? $stmt->FetchAll(PDO::FETCH_ASSOC) : [];
	}

	public function getOne(string $sql, array $params = []): array {
		$stmt = $this->internalExec($sql, $params);
		return $stmt !== NULL ? $stmt->fetch(PDO::FETCH_ASSOC) : array('success' => 'false');;
	}

	public function lastInsertedId(): int{
		return intval($this->pdo->lastInsertId());
	}


	public function getSQLAll(string $table) : string{
        $model = $this->getModel($table);
        if($model == NULL){
            return $response->withStatus(400);
        }
        
        $sql = 'SELECT * FROM '. $table;

        $this->writeSQL($sql);
		return $sql;
	}

	public function getSQLCreate(string $table, array $data): string{
        $model = $this->getModel($table);
        if($model == NULL){
            return 'error';
		}

        $sql = 'INSERT INTO ' . $table . ' (';
        $prepare = '(';

		$length = count($model);
		
        for($i = 0; $i < $length; $i++){
            $sql .= $model[$i];
            $prepare .= '?';
            if($i != $length - 1){
                $sql .= ', ';
                $prepare .= ', ';
            }else{
                $sql .= ')';   
                $prepare .= ')'; 
            }
        }

        $sql = $sql . ' VALUES ' . $prepare;
        $this->writeSQL($sql);
		return $sql;
	}

	public function getSQLUpdate(string $table, array $data): array{
		// Retourne un tableau [0] = sql, [1] = values à rentrer
		$model = $this->getModel($table);
        if($model == NULL){
            return 'error';
		}

        $sql = 'UPDATE '. $table . ' SET ';

		$length = count($model);
		
		$values = [];
        $columns = [];
		$array = array_values($data);
		
		for($i = 0; $i < $length; $i++){
            if($i != 0){
                array_push($values, htmlentities($array[$i]));
                array_push($columns, $model[$i]);
            }
        }       
		array_push($values, htmlentities($array[0])); // Where id = ?
		
        for($i = 0; $i < $length - 1; $i += 1){
            $sql .= $columns[$i] . ' = ?';
            if($i != $length - 2) 
                $sql .= ' ,';
        }
		$sql .= ' WHERE ID = ?';
		$result = [];

		array_push($result, $sql);
        array_push($result, $values);
        
        $this->writeSQL($result);

        return $result;
    }
    
    public function getSQLDelete(string $table){
        $model = $this->getModel($table);
        if($model == NULL){
            return $response->withStatus(400);
        }
        
        $sql = 'DELETE FROM '. $table .' WHERE id = ?';
        $this->writeSQL($sql);

        return $sql;
    }

    private function getModel($table){
        strtolower($table);
        $col = [];
        switch($table){
            case 'adhesion':
                $col = ['ID', 'UsrID', 'DateAdhesion'];
                break;
            case 'affectation':
                $col = ['ServiceID', 'UsrID'];
                break;
            case 'ask' : 
                $col = ['ID', 'UsrMakeID', 'UsrAnwserID', 'CompetenceID', 'Subject', 'DateStart', 'DateEnd'];
                break;
            case 'competence' : 
                $col = ['ID', 'Name'];
                break;
            case 'delivery' : 
                $col = ['ID', 'TruckID', 'UsrID', 'DeliveryTypeID', 'DateStart', 'DateEnd', 'Url'];
                break;
            case 'deliverytype' :
                $col = ['ID', 'Name'];
                break;
            case 'depositery':
                $col = ['ID', 'SiteID', 'Numero', 'Rue', 'Postcode', 'Area', 'Capacity'];
                break;
            case 'ingredient':
                $col = ['ID', 'Name'];
                break;
            case 'inStock':
                $col = ['IngredientID', 'ProductID'];
                break;
            case 'justificatif':
                $col = ['ID', 'Verifie', 'CompetenceID', 'UsrID'];
                break;
            case 'mission':
                $col = ['ID', 'UsrID', 'ServiceID', 'DateStart', 'DateEnd'];
                break;
            case 'product':
                $col = ['ID', 'Name', 'Barcode', 'ValidDate', 'DepositeryID', 'UsrID_Donated', 'UsrID_Received', 'StatutID'];
                break;
            case 'quantity':
                $col = ['ID', 'Quantity', 'RecipeeID', 'IngredientID'];
                break;
            case 'recipee':
                $col = ['ID', 'Name', 'Content', 'Type'];
                break;
            case 'service':
                $col = ['ID', 'Name'];
                break;
            case 'site':
                $col = ['ID', 'Name', 'Numero', 'Rue', 'Postcode', 'Area', 'Capacity'];
                break;
            case 'statut':
                $col = ['ID', 'Name'];
                break;
            case 'stop':
                $col = ['ID', 'DateHour', 'DeliveryID', 'UsrID'];
                break;
            case 'stop_product':
                $col = ['ID', 'StopID','ProductID'];
                break;
            case 'truck':
                $col = ['ID', 'SiteID', 'Plate', 'Name', 'Libre'];
                break;
            case 'usr':
                $col = ['ID', 'SiteID', 'Email', 'Name', 'Surname', 'Password', 'Numero', 'Rue', 'Postcode', 'Area', 'Siret','Eligibility',  'Salary', 'Discriminator', 'Permis', 'Libre'];
                break;
        }
        return $col;
    }

    public function writeSQL($sql){
        // $now = new \DateTime();
        // $now = $now->format('Y-m-d H:i:s');
        // $ligne = $now . " => " + $sql + "\n"; 
        $ligne = "<p>$sql</p>\n"; 


        // 1 : on ouvre le fichier
        $fichier = fopen(__DIR__ . '/../../public/Requetes.txt', 'a+'); // si fichier n'existe pas => création + écrituree fin du fichier
        
        // 2 : on fera ici nos opérations sur le fichier...
        fputs($fichier, $ligne);

        // 3 : quand on a fini de l'utiliser, on ferme le fichier
        fclose($fichier);
    }
}

?>