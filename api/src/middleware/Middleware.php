<?php

namespace App\middleware;

class Middleware
{
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }
}