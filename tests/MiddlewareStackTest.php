<?php

declare(strict_types=1);

namespace Clogger\Tests;

use Clogger\Clogger;
use Clogger\MiddlewareInterface;
use Clogger\MiddlewareStack;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class MiddlewareStackTest extends TestCase
{
    public function testLog(): void
    {
        $level = 'error';
        $message = 'comsimple message';
        $context = ['simple' => 'context'];

        $middleware = $this->prophesize(MiddlewareInterface::class);
        $middleware->process($level, $message, $context)->willReturn([$message, $context])->shouldBeCalled();

        $middlewareStack = new MiddlewareStack($middleware->reveal());
        $middlewareStack->process($level, $message, $context);
    }
}
