<?php

namespace App\config;

use Exception;
use PDO;
use Slim\Http\StatusCode;

class Db
{
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPassword = '';
    private $dbName = 'faotomation';

    public function connect()
    {
       
        try {
            $mysql = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8";
            $connection = new PDO($mysql, $this->dbUser, $this->dbPassword);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            throw new Exception("Database access problem : " . $e->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $connection;
    }
}
