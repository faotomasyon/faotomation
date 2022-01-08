<?php

require  __DIR__ . '/../vendor/autoload.php';

$config = [
    'settings' => [
        'displayErrorDetails' => true,

        'logger' => [
            'name' => 'faotomation',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];

$app = new \Slim\App($config);

require  __DIR__ .'/config/db.php';
require  __DIR__ . '/routes.php';


$app->run();
