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


$queries = [
    'SET FOREIGN_KEY_CHECKS = 0;',
    'TRUNCATE users',
    'TRUNCATE player_details',
    'TRUNCATE classes',
    'TRUNCATE classes_players',
    'TRUNCATE coach_details',
    'TRUNCATE classes_coaches',
    'TRUNCATE coach_notes',
    'TRUNCATE job',
    'SET FOREIGN_KEY_CHECKS = 1;'
];

foreach ($queries as $query) {
    executeQuery($query);
}


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

    $role = rand(0, 2);
    $userId = insertUser($faker->name, $faker->userName, $faker->email, $faker->password, 'test', $role, rand(0, 1));


    if($role == 0){

        $details = [
            'id' => $userId,
            'photo' => $faker->imageUrl($width = 640, $height = 480),
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'birth_place' => $faker->address,
            'weight' => $faker->biasedNumberBetween($min = 40, $max = 80),
            'height' => $faker->biasedNumberBetween($min = 140, $max = 190),
            'position' => $faker->randomElements(['GK', 'SW', 'CB', 'RB', 'LB', 'RWB', 'LWB', 'DM', 'CM', 'AM', 'RW','LW', 'CF', 'S'], 1)[0],
            'foot' => $faker->randomElements(['LEFT', 'BOTH', 'RIGHT'], 1)[0],
            'market_value' => $faker->randomNumber(3),
            'parent_name' => $faker->name,
            'parent_phone' => $faker->phoneNumber,
            'parent_mail' => $faker->email,
            'address' => $faker->address,
            'country_code' => $faker->countryCode
        ];

        insertPlayerDetails($details);
        
    } else if($role == 1){
        
        $details = [
            'id' => $userId,
            'photo' => $faker->imageUrl($width = 640, $height = 480),
            'phone' => $faker->phoneNumber,
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'birth_place' => $faker->address,
            'weight' => $faker->biasedNumberBetween($min = 40, $max = 80),
            'height' => $faker->biasedNumberBetween($min = 140, $max = 190),
            'address' => $faker->address,
            'country_code' => $faker->countryCode
        ];

        insertCoachDetails($details);

    }

}


$logger->info("# SCRIPT FINISHED #");