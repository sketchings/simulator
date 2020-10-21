<?php

declare(strict_types=1);

$container['worlds_service'] = static function ($container): App\Service\WorldsService {
    return new App\Service\WorldsService($container['worlds_repository']);
};
