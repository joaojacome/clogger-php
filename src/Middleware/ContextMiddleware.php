<?php

declare(strict_types=1);

namespace Clogger\Middleware;

use Clogger\ContextualInterface;
use Clogger\MiddlewareInterface;

class ContextMiddleware implements MiddlewareInterface
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
        if ($message instanceof ContextualInterface) {
            $context = array_merge($context, $message->getContext());
        }

        return [$message, $context];
    }
}
