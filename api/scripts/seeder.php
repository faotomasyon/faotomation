<?php

use App\config\Db;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require_once(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../src/config/db.php');
require(__DIR__ . '/lib/lib.php');

$loggerName = 'faotomation';

$flowLogFileName = __DIR__ . '/../logs/flow_seeder.log';

if (!file_exists($flowLogFileName)) {
    fopen($flowLogFileName, "w");
}

$logger = new Logger($loggerName);
$logger->pushHandler(new StreamHandler($flowLogFileName, Monolog\Logger::DEBUG));

$errorLogFileName = __DIR__ . '/../logs/error_seeder.log';

if (!file_exists($errorLogFileName)) {
    fopen($errorLogFileName, "w");
}

$errorLogger = new Logger($loggerName);
$errorLogger->pushHandler(new StreamHandler($errorLogFileName, Monolog\Logger::DEBUG));

$logger->info("# SCRIPT STARTED #");


$dbConnection = new Db();
$conn = $dbConnection->connect();

/**
 * @Roles;
 *      0 => user (player)
 *      1 => coach
 *      2 => admin
*/

/**
 * @Status;
 *      0 => deactive
 *      1 => active
*/

$admins = [
    ['name' => 'administrator', 'lastname' => 'administrator', 'email' => 'admin@admin.com', 'password' => 'admin', 'verification' => 'test', 'role' => 2, 'status' => 1],
];

foreach ($admins as $admin) {
    $adminId = insertUser($admin['name'], $admin['lastname'], $admin['email'], $admin['password'], $admin['verification'], $admin['role'], $admin['status']);
}

$faker = Faker\Factory::create();

for ($i = 0; $i < 10; $i++) {
    insertUser($faker->name, $faker->userName, $faker->email, $faker->password, 'test', rand(1, 2), rand(0, 1));
}


$logger->info("# SCRIPT FINISHED #");