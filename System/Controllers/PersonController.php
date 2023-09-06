<?php

namespace System\Controllers;

use System\Gateways\DbGateway;

class PersonController{

    private $dbGateway;

    public function __construct(private object $dbConnection, private string $requestMethod, private int|null $userId)
    {
        $this->dbGateway = new DbGateway($this->dbConnection);
    }

    public function processRequest()
    {
        $response = match($this->requestMethod) {
            'GET' => isset($this->userId) ? $this->getPerson($this->userId): $this->getAllPersons(),
            //'get', 'head' =>  $this->handleGet(),
            default => $this->notFoundResponse(),
        };

        print_r($response);

    }

    private function getAllPersons()
    {
        $response = $this->dbGateway->all('person', ['id', 'firstname', 'lastname'], 5, ['id', 'desc']);

        return $response;
    }

    private function getPerson(int|null $userId)
    {
        // $response = $this->dbGateway->find($userId);

        // return $response;
    }

    private function notFoundResponse(): void
    {
        
    }

}