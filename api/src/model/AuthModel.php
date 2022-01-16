<?php

namespace App\model;

use App\config\Db;
use Psr\Container\ContainerInterface;

class AuthModel
{
    private $dbConnection;

    public function __construct(ContainerInterface $container)
    {
        $this->dbConnection = new Db();
        $this->dbConnection = $this->dbConnection->connect();
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND status = 1";

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':email', $email, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $user = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $user = $row;
        }

        return $user;
    }
}