<?php

use App\controller;
use App\middleware;

$app->group('', function () {

    $this->get('/', controller\UtilController::class . ':endpoints');

});

$app->group('', function () {

    $this->post('/login', controller\AuthController::class . ':login');
    $this->post('/logout', controller\AuthController::class . ':logout');

});