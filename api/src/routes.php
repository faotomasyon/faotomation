<?php

use App\controller;
use App\middleware\Middleware as MainMiddleware;

$app->group('', function () {

    $this->get('/', controller\UtilController::class . ':endpoints')->setName('home');
    $this->post('/login', controller\AuthController::class . ':login');
});

$app->group('', function () {

    $this->post('/logout', controller\AuthController::class . ':logout');

})->add(new MainMiddleware($container));