<?php

declare(strict_types=1);

namespace Clogger;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Clogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var MiddlewareInterface
     */
    protected $middleware;

    public function __construct(LoggerInterface $logger, MiddlewareInterface $middleware)
    {
        $this->logger = $logger;
        $this->middleware = $middleware;
    }

    /**
     * @param mixed $level
     * @param mixed $message
     */
    public function log($level, $message, array $context = []): void
    {
        [$message, $context] = $this->middleware->process($level, $message, $context);

        $this->logger->log($level, $message, $context);
    }
}
