<?php

namespace App\controller;

use App\model\AuthModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class UtilController extends MainController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function endpoints(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        
        $resource = [
            "GET" => [
                '/' => $_SERVER['HTTP_HOST'],
            ],
            "POST" => [
                'login' => $_SERVER['HTTP_HOST'] . '/login',
                'logout' => $_SERVER['HTTP_HOST'] . '/logout'
            ]
        ];
        
        return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);
    }

}