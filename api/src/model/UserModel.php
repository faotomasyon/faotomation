<?php

namespace App\model;

use App\config\Db;
use Psr\Container\ContainerInterface;

class UserModel
{
    private $dbConnection;

    public function __construct(ContainerInterface $container)
    {
        $this->dbConnection = new Db();
        $this->dbConnection = $this->dbConnection->connect();
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users WHERE role = 0";

        $query = $this->dbConnection->prepare($sql);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $users = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            unset($row['password']);
            $users[] = $row;
        }

        return $users;
    }

    public function getUserInfos($id)
    {
        $sql = "SELECT * FROM users INNER JOIN player_details as pd ON pd.id = users.id WHERE users.id = :id";

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $user = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $user = $row;
        }

        return $user;
    }

    public function addUser($params)
    {
        $sql = 'INSERT INTO users (name, lastname, email, password, verification, role, status)
        VALUES(:name, :lastname, :email, :password, :verification, :role, :status)';

        $password = hash('sha512', $params['password']);
        $verification = hash('sha512', time() . 'testSecretKey' . $password);
        
        $params['role'] = 0;
        $params['status'] = 0;

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':name', $params['name'], \PDO::PARAM_STR);
        $query->bindParam(':lastname', $params['lastname'], \PDO::PARAM_STR);
        $query->bindParam(':email', $params['email'], \PDO::PARAM_STR);
        $query->bindParam(':password', $password, \PDO::PARAM_STR);
        $query->bindParam(':verification', $verification, \PDO::PARAM_INT);
        $query->bindParam(':role', $params['role'], \PDO::PARAM_INT);
        $query->bindParam(':status', $params['status'], \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return $this->dbConnection->lastInsertId();
    }

    public function updateUser($params)
    {
        $sql = 'UPDATE users SET name = :name, lastname = :lastname, email = :email, password = :password, verification = :verification , role = :role, status = :status, updated_at = :updated_at WHERE id = :id';

        $password = hash('sha512', $params['password']);
        
        $updated_at = date("Y-m-d H:i:s");

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $params['id'], \PDO::PARAM_INT);
        $query->bindParam(':name', $params['name'], \PDO::PARAM_STR);
        $query->bindParam(':lastname', $params['lastname'], \PDO::PARAM_STR);
        $query->bindParam(':email', $params['email'], \PDO::PARAM_STR);
        $query->bindParam(':password', $password, \PDO::PARAM_STR);
        $query->bindParam(':verification', $params['verification'], \PDO::PARAM_STR);
        $query->bindParam(':role', $params['role'], \PDO::PARAM_INT);
        $query->bindParam(':status', $params['status'], \PDO::PARAM_INT);
        $query->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not delete. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

}