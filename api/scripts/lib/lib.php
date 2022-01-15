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