<?php

namespace App\middleware;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;

class Middleware
{
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['token'])) {
            
            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        $response = $next($request, $response);

        return $response;

    }

}