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

        if(!isset($_SERVER['CONTENT_TYPE'])){
            $resource['message'] = 'BAD REQUEST! Please check last request. You can use these endpoints.';
            return $this->response(StatusCode::HTTP_BAD_REQUEST, $resource);
        }

        return $this->response(StatusCode::HTTP_OK, $resource);
    }

}