<?php

declare(strict_types=1);

$container['worlds_repository'] = static function ($container): App\Repository\WorldsRepository {
    return new App\Repository\WorldsRepository($container['db']);
};
