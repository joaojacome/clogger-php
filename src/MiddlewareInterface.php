<?php

declare(strict_types=1);

namespace Clogger;

interface MiddlewareInterface
{
    public function process($level, $message, $context): array;
}
