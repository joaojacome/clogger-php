<?php

declare(strict_types=1);

namespace Clogger\Middleware\Exception;

use Clogger\MiddlewareInterface;

class ExceptionSimpleMessageMiddleware implements MiddlewareInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     */
    public function process($level, $message, array $context): array
    {
        if ($message instanceof \Throwable) {
            $message = $message->getMessage();
        }

        return [$message, $context];
    }
}
