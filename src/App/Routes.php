<?php

declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;

$app->group('/api/v1', function (RouteCollectorProxy $group) {
    $group->get('/', 'App\Controller\Api:getHelp');
    $group->get('/status', 'App\Controller\Api:getStatus');

    $group->get('/worlds', App\Controller\Worlds\GetAll::class);
    $group->post('/worlds', App\Controller\Worlds\Create::class);
    $group->get('/worlds/{id}', App\Controller\Worlds\GetOne::class);
    $group->put('/worlds/{id}', App\Controller\Worlds\Update::class);
    $group->delete('/worlds/{id}', App\Controller\Worlds\Delete::class);
});

$app->get('/', 'App\Controller\Home:getHelp');
