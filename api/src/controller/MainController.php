<?php

namespace App\controller;

use Psr\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class MainController
{
    protected $request;
    protected $response;
    protected $data;
    protected $logger;
    protected $container;
    public function __construct(ContainerInterface $container)
    {
       $this->container = $container;
       $this->logger = $container->get('logger');
    }

    public function response($status = StatusCode::HTTP_OK, $data = [], $allow = [])
    {
        if (!isset($this->response)) {
            $this->response = new  Response($status);
        }

        /**
         * @var \Psr\Http\Message\ResponseInterface $response
         */
        $response = $this->response->withStatus($status);

        if (!empty($allow)) {
            $response = $response->withHeader('Allow', strtoupper(implode(',', $allow)));
        }

        if (!empty($data)) {
            $response = $response->withJson($data);
        }

        return $response;
    }

}