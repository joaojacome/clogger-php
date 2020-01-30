<?php

declare(strict_types=1);

namespace Clogger\Middleware;

use Clogger\MiddlewareInterface;

class SimpleMessageMiddleware implements MiddlewareInterface
{
    /**
     * @param string $level
     * @param mixed  $message
     * @param array  $context
     *
     * @return array
     */
    public function process($level, $message, $context): array
    {
        if ($message instanceof \Throwable) {
            $message = $message->getMessage();
        }

        return [$message, $context];
    }
}
