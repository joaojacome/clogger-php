<?php

declare(strict_types=1);

namespace Clogger;

interface ContextualInterface
{
    public function getContext(): array;
}
