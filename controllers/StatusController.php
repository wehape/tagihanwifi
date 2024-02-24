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

class StatusController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/StatusList[/{NomorStatus:.*}]", [PermissionMiddleware::class], "list.status")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/StatusAdd[/{NomorStatus:.*}]", [PermissionMiddleware::class], "add.status")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/StatusView[/{NomorStatus:.*}]", [PermissionMiddleware::class], "view.status")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/StatusEdit[/{NomorStatus:.*}]", [PermissionMiddleware::class], "edit.status")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/StatusDelete[/{NomorStatus:.*}]", [PermissionMiddleware::class], "delete.status")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusDelete");
    }
}
