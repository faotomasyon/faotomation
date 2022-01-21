<?php

namespace App\model;

use App\config\Db;
use Psr\Container\ContainerInterface;

class JobsModel
{
    private $dbConnection;

    public function __construct(ContainerInterface $container)
    {
        $this->dbConnection = new Db();
        $this->dbConnection = $this->dbConnection->connect();
    }

    public function getJobs($type = null, $status = null)
    {
        $sql = "SELECT * FROM job";

        if ($type) {
            $sql .= " WHERE type = :type";
        }

        if ($type && $status) {
            $sql .= " AND status = :status";
        }  
        
        if ($status) {
            $sql .= " WHERE status = :status";
        }

        $query = $this->dbConnection->prepare($sql);
        
        if ($type) {
            $query->bindParam(':type', $type, \PDO::PARAM_INT);
        }
        
        if ($status) {
            $query->bindParam(':status', $status, \PDO::PARAM_INT);
        }

        if (!$query->execute()) {
            $this->logger->addWarning("Jobs could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $jobs = [];
        
        $types = [
            0 => 'Otomatik yoklama',
            1 => 'Otomatik Mail',
            2 => 'Istatik'
        ];

        $status = [
            0 => 'awaiting',
            1 => 'running',
            2 => 'completed'
        ];


        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $row['type'] = $types[$row['type']];
            $row['status'] = $status[$row['status']];
            $jobs[] = $row;
        }

        return $jobs;
    }

    public function getJobById($id,$type = null, $status = null)
    {
        $sql = "SELECT * FROM job WHERE id = :id";
        
        if ($type) {
            $sql .= " AND type = :type";
        }
        
        if ($status) {
            $sql .= " AND status = :status";
        }

        $query = $this->dbConnection->prepare($sql);
        
        if ($type) {
            $query->bindParam(':type', $type, \PDO::PARAM_INT);
        }
        
        if ($status) {
            $query->bindParam(':status', $status, \PDO::PARAM_INT);
        }
        
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Jobs could not fetch. Details = " . json_encode($query->errorInfo()));
        }
        
        $jobs = [];
        
        $types = [
            0 => 'Otomatik yoklama',
            1 => 'Otomatik Mail',
            2 => 'Istatik'
        ];

        $status = [
            0 => 'awaiting',
            1 => 'running',
            2 => 'completed'
        ];


        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $row['type'] = $types[$row['type']];
            $row['status'] = $status[$row['status']];
            $jobs[] = $row;
        }

        return $jobs;
    }

    public function addJob($params)
    {
        $sql = 'INSERT INTO job (type, value, status)
        VALUES(:type, :value, :status)';
        
        $params['status'] = 0;

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':type', $params['type'], \PDO::PARAM_INT);
        $query->bindParam(':value', $params['value'], \PDO::PARAM_STR);
        $query->bindParam(':status', $params['status'], \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Job could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function updateJobStatus($id, $status)
    {
        $sql = 'UPDATE job SET status = :status, updated_at = :updated_at WHERE id = :id';

        $updated_at = date("Y-m-d H:i:s");

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':status', $status, \PDO::PARAM_STR);
        $query->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Job status could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function updateJobValue($id, $value)
    {
        $sql = 'UPDATE job SET value = :value, updated_at = :updated_at WHERE id = :id';

        $updated_at = date("Y-m-d H:i:s");

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->bindParam(':value', $value, \PDO::PARAM_STR);
        $query->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Job value could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function updateJob($params)
    {
        $sql = 'UPDATE job SET value = :value, status = :status, updated_at = :updated_at WHERE id = :id';

        $updated_at = date("Y-m-d H:i:s");

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $params['id'], \PDO::PARAM_INT);
        $query->bindParam(':value', $params['value'], \PDO::PARAM_STR);
        $query->bindParam(':status', $params['status'], \PDO::PARAM_INT);
        $query->bindParam(':updated_at', $updated_at, \PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Job could not insert. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

    public function deleteJob($id)
    {
        $sql = 'DELETE FROM job WHERE id = :id';

        $query = $this->dbConnection->prepare($sql);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $this->logger->addWarning("Job could not delete. Details = " . json_encode($query->errorInfo()));
            return false;
        }
    
        return true;
    }

}