<?php

function executeQuery($query)
{
    $conn = $GLOBALS['conn'];
    $logger = $GLOBALS['logger'];
    $errorLogger = $GLOBALS['errorLogger'];

    $logger->info("Executing query: $query");

    $query = $conn->prepare($query);

    if (!$query->execute()) {
        $errorLogger->error("Query could not execute. Error detail: " . json_encode($query->errorInfo()));
        return false;
    }

    return true;
}

function insertUser($name, $lastname, $email, $password, $verification, $role, $status)
{
    $conn = $GLOBALS['conn'];
    $password = hash('sha512', $password);

    $sql = 'INSERT INTO users (id, name, lastname, email, password, verification, role, status)
        VALUES(UUID(), :name, :lastname, :email, :password, :verification, :role, :status)';

    $query = $conn->prepare($sql);
    $query->bindParam(':name', $name, \PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, \PDO::PARAM_STR);
    $query->bindParam(':email', $email, \PDO::PARAM_STR);
    $query->bindParam(':password', $password, \PDO::PARAM_STR);
    $query->bindParam(':verification', $verification, \PDO::PARAM_INT);
    $query->bindParam(':role', $role, \PDO::PARAM_INT);
    $query->bindParam(':status', $status, \PDO::PARAM_INT);

    if (!$query->execute()) {
        die(json_encode($query->errorInfo()));
    }

    return $conn->lastInsertId();
}