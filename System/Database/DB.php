<?php

namespace System\Database;

class DB {
    
    private $dbHost;
    private $dbUsername;
    private $dbPassword;
    private $dbName;

    private $conncetion = null;

    public function __construct()
    {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbUsername = $_ENV['DB_USERNAME'];
        $this->dbPassword = $_ENV['DB_PASSWORD'];
        $this->dbName = $_ENV['DB_NAME'];

        try {
            $this->conncetion = new \PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
            // set the PDO error mode to exception
            $this->conncetion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
           
          } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

    public function getConnection() :object
    {
        return $this->conncetion;
    }

}