<?php

namespace App\model;

use App\config\Db;
use Psr\Container\ContainerInterface;
use Slim\Http\StatusCode;

class AuthModel
{
    private $dbConnection;

    public function __construct(ContainerInterface $container)
    {
        $this->dbConnection = new Db();
        $this->dbConnection->connect();
    }

    public function login($params)
    {
        return true;
    }
}