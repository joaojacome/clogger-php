<?php

declare(strict_types=1);

namespace Clogger\Middleware;

use Clogger\MiddlewareInterface;

class StackTraceMiddleware implements MiddlewareInterface
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
            $context = array_merge($context, [
                'stack_trace' => $message->getTraceAsString(),
            ]);
        }

        return [$message, $context];
    }
}
