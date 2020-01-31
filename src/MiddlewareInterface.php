<?php

declare(strict_types=1);

namespace Clogger;

interface MiddlewareInterface
{
    /**
     * @param mixed $level
     * @param mixed $message
     */
    public function process($level, $message, array $context): array;
}
