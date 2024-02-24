<?php

namespace PHPMaker2024\tagihanwifi01;

use Slim\Routing\RouteContext;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Permission middleware
 */
class PermissionMiddleware
{
    // Invoke
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        global $Language, $Security;

        // Request
        $GLOBALS["Request"] = $request;
        $routeName = RouteName();
        $ar = explode(".", $routeName);
        $pageAction = $ar[0] ?? ""; // Page action
        $table = $ar[1] ?? ""; // Table

        // Page ID
        if (!defined(PROJECT_NAMESPACE . "PAGE_ID")) {
            define(PROJECT_NAMESPACE . "PAGE_ID", $pageAction);
        }

        // Language
        $Language = Container("app.language");

        // Security
        $Security = Container("app.security");

        // Current table
        if ($table != "") {
            $GLOBALS["Table"] = Container($table);
        }

        // Validate CSRF
        if (Config("CHECK_TOKEN") && !IsSamlResponse() && !ValidateCsrf($request)) {
            throw new HttpBadRequestException($request, $Language->phrase("InvalidPostRequest"));
        }

        // Handle request
        return $handler->handle($request);
    }

    // Redirect
    public function redirect(string $routeName = "login")
    {
        global $Request, $ResponseFactory, $Security;
        $response = $ResponseFactory->createResponse(); // Create response
        $GLOBALS["Response"] = &$response; // Note: global $Response does not work
        if ($routeName == "login") {
            $Security->saveLastUrl(); // Save last URL for redirection after login
        }
        if (
            $Request->getQueryParam("modal") == "1" && // Modal
            !($routeName == "login" && Config("USE_MODAL_LOGIN")) // Not modal login
        ) {
            return $response->withJson(["url" => UrlFor($routeName)]);
        }
        return $response->withHeader("Location", UrlFor($routeName))->withStatus(302);
    }
}
