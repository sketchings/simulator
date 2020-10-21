<?php

declare(strict_types=1);

namespace App\Controller\Worlds;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $worlds = $this->getWorldsService()->getOne((int) $args['id']);

        $response->getBody()->write($worlds->terrain);
        return $response
            ->withHeader('Content-Type', 'text/plain')
            ->withStatus(200);
    }
}
