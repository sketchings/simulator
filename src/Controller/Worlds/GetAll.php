<?php

declare(strict_types=1);

namespace App\Controller\Worlds;

use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $worldss = $this->getWorldsService()->getAll();

        return JsonResponse::withJson($response, json_encode($worldss));
    }
}
