<?php

require  __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true
    ],
];


session_name('faotomation');
session_start();

$app = new \Slim\App($config);

$container = $app->getContainer();

$container['logger'] = function ($c) {
    $logger = new Monolog\Logger('faotomation');
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../logs/app.log', \Monolog\Logger::DEBUG));
    return $logger;
};

require  __DIR__ .'/config/db.php';
require  __DIR__ . '/routes.php';

$app->run();
