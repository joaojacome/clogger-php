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
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    public function __construct(LoggerInterface $logger, MiddlewareInterface ...$middlewares)
    {
        $this->logger = $logger;
        $this->middlewares = $middlewares;
    }

    /**
     * @param mixed $level
     * @param mixed $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        foreach ($this->middlewares as $middleware) {
            [$message, $context] = $middleware->process($level, $message, $context);
        }

        $this->logger->log($level, $message, $context);
    }
}
