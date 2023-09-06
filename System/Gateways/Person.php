<?php

namespace System\Gateways;

require '../System/Traits/ResponseTrait.php';

use System\Traits\ResponseTrait;

class Person{

    use ResponseTrait;
    
    private $dbConnection = null;

    public function __construct($dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function all()
    {
        try {
            
            $stmt = $this->dbConnection->prepare("SELECT id, firstname, lastname FROM person");

            $stmt->execute();

            // set the resulting array to associative
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);

            $result = $stmt->fetchAll();

            return ResponseTrait::response($result, 200, 'success');

          } catch(\PDOException $e) {
            
            return ResponseTrait::response([], 500, $e->getMessage());

          }
    }

    public function find(int|null $userId)
    {
        try {

            $sth = $this->dbConnection->prepare('SELECT id, firstname, lastname
                                FROM person
                                WHERE id = ?');

            $sth->execute([$userId]);

            $sth->setFetchMode(\PDO::FETCH_ASSOC);

            $result  = $sth->fetchAll();

            return ResponseTrait::response($result, 200, 'success');

        } catch (\PDOException $e) {

            return ResponseTrait::response([], 500, $e->getMessage());

        }
    }

}