<?php

namespace PHPMaker2024\tagihanwifi01;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\tagihanwifi01\Attributes\Delete;
use PHPMaker2024\tagihanwifi01\Attributes\Get;
use PHPMaker2024\tagihanwifi01\Attributes\Map;
use PHPMaker2024\tagihanwifi01\Attributes\Options;
use PHPMaker2024\tagihanwifi01\Attributes\Patch;
use PHPMaker2024\tagihanwifi01\Attributes\Post;
use PHPMaker2024\tagihanwifi01\Attributes\Put;

/**
 * Billing_Report controller
 */
class BillingReportController extends ControllerBase
{
    // summary
    #[Map(["GET", "POST", "OPTIONS"], "/BillingReport", [PermissionMiddleware::class], "summary.Billing_Report")]
    public function summary(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BillingReportSummary");
    }
}
