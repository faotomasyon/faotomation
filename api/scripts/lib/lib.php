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

    $logger = $GLOBALS['logger'];
    $errorLogger = $GLOBALS['errorLogger'];

    $logger->info("Users adding email: $email");

    $sql = 'INSERT INTO users (name, lastname, email, password, verification, role, status)
        VALUES(:name, :lastname, :email, :password, :verification, :role, :status)';

    $query = $conn->prepare($sql);
    $query->bindParam(':name', $name, \PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, \PDO::PARAM_STR);
    $query->bindParam(':email', $email, \PDO::PARAM_STR);
    $query->bindParam(':password', $password, \PDO::PARAM_STR);
    $query->bindParam(':verification', $verification, \PDO::PARAM_INT);
    $query->bindParam(':role', $role, \PDO::PARAM_INT);
    $query->bindParam(':status', $status, \PDO::PARAM_INT);

    if (!$query->execute()) {
        $errorLogger->error("Query could not execute. Error detail: " . json_encode($query->errorInfo()));
        return false;
    }

    return $conn->lastInsertId();
}

function insertPlayerDetails($details)
{
    $conn = $GLOBALS['conn'];

    $logger = $GLOBALS['logger'];
    $errorLogger = $GLOBALS['errorLogger'];

    $logger->info("Users details adding");

    $sql = 'INSERT INTO player_details (id, photo, birth_date, birth_place, weight, height, position, foot, market_value, parent_name, parent_phone, parent_mail, address, country_code)
            VALUES(:id, :photo, :birth_date, :birth_place, :weight, :height, :position, :foot, :market_value, :parent_name, :parent_phone, :parent_mail, :address, :country_code)';

    $query = $conn->prepare($sql);
    $query->bindParam(':id', $details['id'], \PDO::PARAM_INT);
    $query->bindParam(':photo', $details['photo'], \PDO::PARAM_STR);
    $query->bindParam(':birth_date', $details['birth_date'], \PDO::PARAM_STR);
    $query->bindParam(':birth_place', $details['birth_place'], \PDO::PARAM_STR);
    $query->bindParam(':weight', $details['weight'], \PDO::PARAM_INT);
    $query->bindParam(':height', $details['height'], \PDO::PARAM_INT);
    $query->bindParam(':position', $details['position'], \PDO::PARAM_STR);
    $query->bindParam(':foot', $details['foot'], \PDO::PARAM_STR);
    $query->bindParam(':market_value', $details['market_value'], \PDO::PARAM_INT);
    $query->bindParam(':parent_name', $details['parent_name'], \PDO::PARAM_STR);
    $query->bindParam(':parent_phone', $details['parent_phone'], \PDO::PARAM_INT);
    $query->bindParam(':parent_mail', $details['parent_mail'], \PDO::PARAM_STR);
    $query->bindParam(':address', $details['address'], \PDO::PARAM_STR);
    $query->bindParam(':country_code', $details['country_code'], \PDO::PARAM_STR);

    if (!$query->execute()) {
        $errorLogger->error("Query could not execute. Error detail: " . json_encode($query->errorInfo()));
        return false;
    }

    return true;
}

function insertCoachDetails($details)
{
    $conn = $GLOBALS['conn'];

    $logger = $GLOBALS['logger'];
    $errorLogger = $GLOBALS['errorLogger'];

    $logger->info("Users details adding");

    $sql = 'INSERT INTO coach_details (id, photo, phone, birth_date, birth_place, weight, height, address, country_code)
            VALUES(:id, :photo, :phone, :birth_date, :birth_place, :weight, :height, :address, :country_code)';

    $query = $conn->prepare($sql);
    $query->bindParam(':id', $details['id'], \PDO::PARAM_INT);
    $query->bindParam(':photo', $details['photo'], \PDO::PARAM_STR);
    $query->bindParam(':phone', $details['phone'], \PDO::PARAM_INT);
    $query->bindParam(':birth_date', $details['birth_date'], \PDO::PARAM_STR);
    $query->bindParam(':birth_place', $details['birth_place'], \PDO::PARAM_STR);
    $query->bindParam(':weight', $details['weight'], \PDO::PARAM_INT);
    $query->bindParam(':height', $details['height'], \PDO::PARAM_INT);
    $query->bindParam(':address', $details['address'], \PDO::PARAM_STR);
    $query->bindParam(':country_code', $details['country_code'], \PDO::PARAM_STR);

    if (!$query->execute()) {
        $errorLogger->error("Query could not execute. Error detail: " . json_encode($query->errorInfo()));
        return false;
    }

    return true;
}