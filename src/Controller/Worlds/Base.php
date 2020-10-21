<?php

declare(strict_types=1);

namespace App\Controller\Worlds;

use App\Service\WorldsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected $container;

    protected $worldsService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getWorldsService(): WorldsService
    {
        return $this->container->get('worlds_service');
    }
}
