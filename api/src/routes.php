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


$app->group('/users', function () {

    $this->get('', controller\UserController::class . ':getUsers');
    $this->get('/{id:[0-9]+}', controller\UserController::class . ':getUserDetail');
    $this->post('', controller\UserController::class . ':addUser');
    $this->put('/{id:[0-9]+}', controller\UserController::class . ':updateUser');
    $this->delete('/{id:[0-9]+}', controller\UserController::class . ':deleteUser');

})->add(new MainMiddleware($container));

$app->group('/coaches', function () {

    $this->get('', controller\CoachController::class . ':getCoach');
    $this->get('/{id:[0-9]+}', controller\CoachController::class . ':getCoachDetail');
    $this->post('', controller\CoachController::class . ':addCoach');
    $this->put('/{id:[0-9]+}', controller\CoachController::class . ':updateCoach');
    $this->delete('/{id:[0-9]+}', controller\CoachController::class . ':deleteCoach');

})->add(new MainMiddleware($container));

$app->group('/jobs', function () {

    $this->get('', controller\JobsController::class . ':getJobs');
    $this->get('/{id:[0-9]+}', controller\JobsController::class . ':getJobById');
    $this->post('', controller\JobsController::class . ':addJob');
    $this->put('/{id:[0-9]+}', controller\JobsController::class . ':updateJob');
    $this->put('/values/{id:[0-9]+}', controller\JobsController::class . ':updateJobValue');
    $this->put('/status/{id:[0-9]+}', controller\JobsController::class . ':updateJobStatus');
    $this->delete('/{id:[0-9]+}', controller\JobsController::class . ':deleteJob');

})->add(new MainMiddleware($container));