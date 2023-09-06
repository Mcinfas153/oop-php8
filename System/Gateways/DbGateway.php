<?php

namespace System\Gateways;

use System\Traits\ResponseTrait;

class DbGateway {

    use ResponseTrait;

    public function __construct(private object $dbConnection){}

    public function all(string $tableName, array $columns = ['*'], int|null $limit = null, array $orderBy = ['id', 'asc'])
    {
        $selectedColumns = implode(',', $columns);

        try {

            $sql = 'SELECT '.$selectedColumns.'
                    FROM '.$tableName.
                    ' ORDER BY '.$orderBy[0]. ' '.$orderBy[1];

            if(isset($limit)) {
                $sql .= ' LIMIT '.$limit;
            }

            $sth = $this->dbConnection->prepare($sql);

            $sth->execute();

            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            
            return ResponseTrait::response($result, 200, 'success');

        } catch (\PDOException $e) {

            return ResponseTrait::response([], 200, $e->getMessage());

        }

    }

}