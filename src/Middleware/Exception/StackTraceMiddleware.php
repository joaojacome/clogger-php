<?php

declare(strict_types=1);

namespace Clogger\Middleware\Exception;

use Clogger\MiddlewareInterface;

class StackTraceMiddleware implements MiddlewareInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     */
    public function process($level, $message, array $context): array
    {
        if ($message instanceof \Throwable) {
            $context = array_merge($context, [
                'stack_trace' => $message->getTraceAsString(),
            ]);
        }

        return [$message, $context];
    }
}
