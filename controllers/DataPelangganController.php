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

class DataPelangganController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/DataPelangganList[/{NomorPelanggan:.*}]", [PermissionMiddleware::class], "list.data_pelanggan")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DataPelangganList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/DataPelangganAdd[/{NomorPelanggan:.*}]", [PermissionMiddleware::class], "add.data_pelanggan")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DataPelangganAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/DataPelangganView[/{NomorPelanggan:.*}]", [PermissionMiddleware::class], "view.data_pelanggan")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DataPelangganView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/DataPelangganEdit[/{NomorPelanggan:.*}]", [PermissionMiddleware::class], "edit.data_pelanggan")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DataPelangganEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/DataPelangganDelete[/{NomorPelanggan:.*}]", [PermissionMiddleware::class], "delete.data_pelanggan")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DataPelangganDelete");
    }
}
