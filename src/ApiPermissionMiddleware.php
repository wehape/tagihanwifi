<?php

namespace PHPMaker2024\tagihanwifi01;

use Slim\Routing\RouteContext;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Support\Collection;

/**
 * Permission middleware
 */
class ApiPermissionMiddleware
{
    // Invoke
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        global $Security, $Language, $ResponseFactory;

        // Set up request
        $GLOBALS["Request"] = $request;

        // Create Response
        $response = $ResponseFactory->createResponse();
        $action = Route(0);
        $table = "";
        $checkToken = match ($action) {
            Config("API_SESSION_ACTION"), Config("API_EXPORT_CHART_ACTION"), Config("API_2FA_ACTION") => true,
            Config("API_JQUERY_UPLOAD_ACTION") => $request->isPost(),
            default => false,
        };

        // Validate JWT
        if ($checkToken) { // Check token
            $jwt = $request->getAttribute("JWT"); // Try get JWT from request attribute
            if ($jwt === null) {
                $token = preg_replace('/^Bearer\s+/', "", $request->getHeaderLine(Config("JWT.AUTH_HEADER"))); // Get bearer token from HTTP header
                if ($token) {
                    $jwt = DecodeJwt($token);
                }
            }
            if ((int)($jwt["userlevel"] ?? PHP_INT_MIN) < AdvancedSecurity::ANONYMOUS_USER_LEVEL_ID) { // Invalid JWT token
                return $response->withStatus(401); // Not authorized
            }
        }

        // Actions for table
        $apiTableActions = [
            Config("API_EXPORT_ACTION"),
            Config("API_LIST_ACTION"),
            Config("API_VIEW_ACTION"),
            Config("API_ADD_ACTION"),
            Config("API_EDIT_ACTION"),
            Config("API_DELETE_ACTION"),
            Config("API_FILE_ACTION")
        ];
        if (in_array($action, $apiTableActions)) {
            $table = Route("table") ?? Param(Config("API_OBJECT_NAME")); // Get from route or Get/Post
        }

        // Language
        $Language = Container("app.language");

        // Security
        $Security = Container("app.security");

        // No security
        $authorised = true;
        if (!$authorised) {
            return $response->withStatus(401); // Not authorized
        }

        // Handle request
        return $handler->handle($request);
    }
}
