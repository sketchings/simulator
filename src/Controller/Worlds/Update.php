<?php

declare(strict_types=1);

namespace App\Controller\Worlds;

use App\Controller\Gravity;
use App\Helper\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $worlds = $this->getWorldsService()->getOne((int) $args['id']);
        $terrain = Gravity::addTerrain($input['terrain'], $worlds->terrain);
        $worlds = $this->getWorldsService()->update(["terrain"=>$terrain], (int) $args['id']);

        return JsonResponse::withJson($response, json_encode($worlds));
    }
}
