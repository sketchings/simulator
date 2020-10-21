<?php

declare(strict_types=1);

namespace App\Controller\Worlds;

use App\Controller\Gravity;
use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $terrain = Gravity::addTerrain($input['terrain']);
        $worlds = $this->getWorldsService()->create(["terrain"=>$terrain]);

        return JsonResponse::withJson($response, json_encode($worlds), 201);
    }
}
