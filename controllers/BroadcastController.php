<?php

namespace PHPMaker2024\tagihanwifi01;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\tagihanwifi01\Attributes\Delete;
use PHPMaker2024\tagihanwifi01\Attributes\Get;
use PHPMaker2024\tagihanwifi01\Attributes\Map;
use PHPMaker2024\tagihanwifi01\Attributes\Options;
use PHPMaker2024\tagihanwifi01\Attributes\Patch;
use PHPMaker2024\tagihanwifi01\Attributes\Post;
use PHPMaker2024\tagihanwifi01\Attributes\Put;

class BroadcastController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/BroadcastList[/{NomorBC:.*}]", [PermissionMiddleware::class], "list.broadcast")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BroadcastList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/BroadcastAdd[/{NomorBC:.*}]", [PermissionMiddleware::class], "add.broadcast")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BroadcastAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/BroadcastView[/{NomorBC:.*}]", [PermissionMiddleware::class], "view.broadcast")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BroadcastView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/BroadcastEdit[/{NomorBC:.*}]", [PermissionMiddleware::class], "edit.broadcast")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BroadcastEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/BroadcastDelete[/{NomorBC:.*}]", [PermissionMiddleware::class], "delete.broadcast")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BroadcastDelete");
    }
}
