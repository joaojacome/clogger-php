<?php

declare(strict_types=1);

namespace Clogger;

interface ContextualInterface
{
    /**
     * @param mixed $context
     *
     * @return mixed
     */
    public function setContext($context);

    /**
     * @return mixed
     */
    public function getContext();
}
