<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;
use Phalcon\Http\Response;

use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/config/',
    ]
);

$loader->register();

$di = new FactoryDefault();

// $di->set('db', function(){
//     return new PdoMysql(array(
//         "host" => "localhost",
//        "username" => "phalcon",
//        "password" => "secret",
//        "dbname" => "phalcondb"
//    ));
// });


$app = new Micro($di);
new Routes($app);

// $app->get('/api/user/{id:[0-9]+}', function ($id) { 
//     $users = [
//         'id' => $id,
//         'first_name' => 'Gordon',
//         'last_name' => 'Test',
//         'state' => 'QLD'
//     ];

//     $response = new Response();
//     $response->setStatusCode(200, 'Ok');
//     $response->setJsonContent($users);
//     return $response;
// });

$di->set('app', function() use ($app) {
    return $app;
});

try {
    $app->handle();
} catch (\Exception $e) {
    echo "unable to handle request, error: ", $e->getMessage();
}

?>