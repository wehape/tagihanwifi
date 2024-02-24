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

class SubscriptionController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/SubscriptionList[/{NomorSubscription:.*}]", [PermissionMiddleware::class], "list.subscription")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/SubscriptionAdd[/{NomorSubscription:.*}]", [PermissionMiddleware::class], "add.subscription")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/SubscriptionView[/{NomorSubscription:.*}]", [PermissionMiddleware::class], "view.subscription")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/SubscriptionEdit[/{NomorSubscription:.*}]", [PermissionMiddleware::class], "edit.subscription")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/SubscriptionDelete[/{NomorSubscription:.*}]", [PermissionMiddleware::class], "delete.subscription")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SubscriptionDelete");
    }
}
