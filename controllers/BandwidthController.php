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

class BandwidthController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/BandwidthList[/{NomorBandwidth:.*}]", [PermissionMiddleware::class], "list.bandwidth")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BandwidthList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/BandwidthAdd[/{NomorBandwidth:.*}]", [PermissionMiddleware::class], "add.bandwidth")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BandwidthAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/BandwidthView[/{NomorBandwidth:.*}]", [PermissionMiddleware::class], "view.bandwidth")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BandwidthView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/BandwidthEdit[/{NomorBandwidth:.*}]", [PermissionMiddleware::class], "edit.bandwidth")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BandwidthEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/BandwidthDelete[/{NomorBandwidth:.*}]", [PermissionMiddleware::class], "delete.bandwidth")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BandwidthDelete");
    }
}
