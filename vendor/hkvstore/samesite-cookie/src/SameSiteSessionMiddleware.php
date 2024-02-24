<?php

namespace Selective\SameSiteCookie;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * SameSite Session Middleware.
 */
final class SameSiteSessionMiddleware implements MiddlewareInterface
{
    /**
     * @var SessionHandlerInterface
     */
    private $sessionHandler;

    /**
     * @var SameSiteCookieConfiguration
     */
    private $configuration;

    /**
     * The constructor.
     *
     * @param SessionHandlerInterface|null $sessionHandler The session handler
     */
    public function __construct(
        SessionHandlerInterface $sessionHandler = null,
        SameSiteCookieConfiguration $configuration = null
    ) {
        $this->sessionHandler = $sessionHandler ?: new PhpSessionHandler();
        $this->configuration = $configuration ?: new SameSiteCookieConfiguration();
    }

    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($this->configuration->startSession && !$this->sessionHandler->isStarted()) {
            $this->sessionHandler->start();
        }

        $response = $handler->handle($request);

        if ($this->sessionHandler->isStarted()) {
            $this->sessionHandler->save();
        }

        return $response;
    }
}
