<?php

use Phalcon\Mvc\Router;

$router = new Router(false);

$router->add(
    '/',
    [
        'controller' => 'index',
        'action' => 'index',
    ]
);

$router->add(
    '/user',
    [
        'controller' => 'user',
        'action' => 'index',
    ]
);

$router->add(
    '/user/insert',
    [
        'controller' => 'user',
        'action' => 'insert',
    ]
);

$router->add(
    '/address',
    [
        'controller' => 'address',
        'action' => 'index',
    ]
);

$router->add(
    '/address/list',
    [
        'controller' => 'address',
        'action' => 'list',
    ]
);

$router->add(
    '/address/editUser/:int',
    [
        'controller' => 'address',
        'action' => 'editUser',
        'params' => 1
    ]
);

$router->add(
    '/address/delete/:int',
    [
        'controller' => 'address',
        'action' => 'delete',
        'params' => 1
    ]
);

$router->notFound(
    [
        'controller' => 'index',
        'action' => 'route404',
    ]
);

return $router;