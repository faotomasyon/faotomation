<?php

use App\controller;
use App\middleware;

$app->group('', function () {

    $this->get('/test', controller\AuthController::class . ':test')->setName('login');

});