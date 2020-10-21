<?php

declare(strict_types=1);

namespace App\Controller;

use Pimple\Psr11\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Home
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getHelp(Request $request, Response $response): Response
    {
        $response->getBody()->write("Visit /api/vi");
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
    }
}
