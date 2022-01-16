<?php

namespace App\model;

use App\config\Db;
use Psr\Container\ContainerInterface;

class CoachModel
{
    private $dbConnection;

    public function __construct(ContainerInterface $container)
    {
        $this->dbConnection = new Db();
        $this->dbConnection = $this->dbConnection->connect();
    }

    public function getCoaches()
    {
        $sql = "SELECT * FROM users WHERE role = 1";

        $query = $this->dbConnection->prepare($sql);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Coaches could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $users = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            unset($row['password']);
            $users[] = $row;
        }

        return $users;
    }

    public function getCoachInfos($id)
    {
        $sql = "SELECT * FROM users INNER JOIN coach_details as pd ON pd.id = users.id WHERE users.id = :id AND role = 1";

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

    public function addCoach($params)
    {
        $sql = 'INSERT INTO users (name, lastname, email, password, verification, role, status)
        VALUES(:name, :lastname, :email, :password, :verification, :role, :status)';

        $password = hash('sha512', $params['password']);
        $verification = hash('sha512', time() . 'testSecretKey' . $password);
        
        $params['role'] = 1;
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

    public function updateCoach($params)
    {
        $sql = 'UPDATE users SET name = :name, lastname = :lastname, email = :email, password = :password, verification = :verification, status = :status, updated_at = :updated_at WHERE id = :id AND role = 1';

        $password = hash('sha512', $params['password']);
        
        $updated_at = date("Y-m-d H:i:s");

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $params['id'], \PDO::PARAM_INT);
        $query->bindParam(':name', $params['name'], \PDO::PARAM_STR);
        $query->bindParam(':lastname', $params['lastname'], \PDO::PARAM_STR);
        $query->bindParam(':email', $params['email'], \PDO::PARAM_STR);
        $query->bindParam(':password', $password, \PDO::PARAM_STR);
        $query->bindParam(':verification', $params['verification'], \PDO::PARAM_STR);
        $query->bindParam(':status', $params['status'], \PDO::PARAM_INT);
        $query->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function deleteCoach($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id AND role = 1';

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("User could not delete. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

}