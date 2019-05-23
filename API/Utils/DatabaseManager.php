<?php

require_once __DIR__ . '/.conf.php';

class DatabaseManager {
	private $pdo;

	 // 1.
	private static $manager;

	 // 2.
	private function __construct(){
		$conn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
		$this->pdo = new PDO($conn, DB_USER, DB_PWD);
	}

	// 3.
	public static function getManager(): DatabaseManager{ 
		// DatabaseManager::getManager();
		if(!isset(self::$manager)){
			self::$manager = new DatabaseManager();
		}
		return self::$manager;
	}

	private function internalExec(string $sql, array $params = []): ?PDOStatement {
		$stmt = $this->pdo->prepare($sql);
		if($stmt !== false){
			$success = $stmt->execute($params);
			if($success !==false){
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

	public function getOne(string $sql, array $params = []): array{
		$stmt = $this->internalExec($sql, $params);
		return $stmt !== NULL ? $stmt->fetch(PDO::FETCH_ASSOC) : NULL;
	}

	public function lastInsertedId(): int{
		return intval($this->pdo->lastInsertId());
	}
}

?>