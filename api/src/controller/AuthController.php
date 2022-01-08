<?php

namespace App\controller;

use App\model\AuthModel;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\StatusCode;

class AuthController extends MainController
{
    private $authModel;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->authModel = new AuthModel($container);
    }

    public function test(ServerRequestInterface $request, ResponseInterface $response, $args)
    {   
        $resource = [
            "message" => "Success!"
        ];
        
        // $this->logger('test');

        return $this->response(StatusCode::HTTP_OK, $resource);
    }

}