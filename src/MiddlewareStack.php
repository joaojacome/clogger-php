<?php

declare(strict_types=1);

namespace Clogger;

class MiddlewareStack implements MiddlewareInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares = [];

    public function __construct(MiddlewareInterface ...$middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function process($level, $message, array $context = []): array
    {
        foreach ($this->middlewares as $middleware) {
            [$message, $context] = $middleware->process($level, $message, $context);
        }

        return [$message, $context];
    }
}
