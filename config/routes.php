<?php

use Phalcon\Mvc\Router;

$router = new Router(false);


$router->notFound(
    [
        'controller' => 'index',
        'action' => 'route404',
    ]
);

$router->add(
    '/',
    [
        'controller' => 'index',
        'action' => 'index',
    ]
);

$router->add(
    '/user/edit/:int',
    [
        'controller' => 'user',
        'action' => 'edit',
        'params' => 1
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
    '/user/save',
    [
        'controller' => 'user',
        'action' => 'save',
    ]
)->via([
    'POST',
]);


$router->add(
    '/address',
    [
        'controller' => 'address',
        'action' => 'index',
    ]
);

$router->add(
    '/address/listContent',
    [
        'controller' => 'address',
        'action' => 'listContent',
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

$router->add(
    '/address/save',
    [
        'controller' => 'address',
        'action' => 'save',
    ]
)->via([
    'POST',
]);

return $router;