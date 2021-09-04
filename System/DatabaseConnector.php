<?php
//namespace Src\System;

class DatabaseConnector {

    private $dbConnection = null;

    public function __construct()
    {
        $host = 'localhost';//getenv('DB_HOST');
        $port = '3306'; //getenv('DB_PORT');
        $db   = 'wirzkalender'; //getenv('DB_DATABASE');
        $user = 'api_user'; //getenv('DB_USERNAME');
        $pass = '12345'; //getenv('DB_PASSWORD');

        try {
            $this->dbConnection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}