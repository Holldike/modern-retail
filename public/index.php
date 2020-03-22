<?php

use Phalcon\Url;
use Phalcon\Loader;
use Phalcon\Escaper;
use Phalcon\Mvc\View;
use Phalcon\Session\Manager;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Session\Adapter\Files;
use Phalcon\Flash\Session as Flash;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/src');

$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/forms/',
    ]
);

$loader->register();

$container = new FactoryDefault();
$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');

        return $view;
    }
);
$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');

        return $url;
    }
);

$container->set('session', function() {
    $session = new Files();
    $session->start();
    return $session;
}, true);

$container->set(
    'flashSession',
    function () {
        $session = new Manager();
        $escaper = new Escaper();

        $flash = new Flash($escaper, $session);
        $flash->setCssClasses(
            [
                'error'   => 'alert-danger',
                'success' => 'alert-success',
            ]
        );
        $flash->setImplicitFlush(false);

        return $flash;
    }
);
$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host' => 'db',
                'username' => 'root',
                'password' => 'root',
                'dbname' => 'modern_retail',
            ]
        );
    }
);
$container->set(
    'router',
    function () {
        require __DIR__ . '/../config/routes.php';

        return $router;
    }
);

$application = new Application($container);

try {
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
