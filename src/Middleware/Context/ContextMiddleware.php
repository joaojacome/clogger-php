<?php

declare(strict_types=1);

namespace Clogger\Middleware\Context;

use Clogger\ContextualInterface;
use Clogger\MiddlewareInterface;

class ContextMiddleware implements MiddlewareInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     */
    public function process($level, $message, array $context): array
    {
        if ($message instanceof ContextualInterface) {
            $context = array_merge($context, $message->getContext());
        }

        return [$message, $context];
    }
}
