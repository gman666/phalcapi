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
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/config/',
    ]
)->register();

// setup models
// $loader->registerNamespaces([
//     'Droids\Mechanoids' => __DIR__ . '/models/',
// ]);

// $loader->registerNamespaces([
//     'app\config' => __DIR__ . '/config/',
// ]);

$di = new FactoryDefault();

// init db
$di->set('db', function(){
    return new PdoMysql(array(
        "host" => "localhost",
       "username" => "root",
       "password" => "",
       "dbname" => "phalcondb"
   ));
});

require('config/Routes.php');
require('controllers/RobotsController.php');
require('models/Robots.php');

$app = new Micro($di);
new \config\Routes($app);

$di->set('app', function() use ($app) {
    return $app;
});

try {
    $app->handle();
} catch (\Exception $e) {
    echo "unable to handle request, error: ", $e->getMessage();
}

?>