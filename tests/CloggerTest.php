<?php

declare(strict_types=1);

namespace Clogger\Tests;

use Clogger\Clogger;
use Clogger\MiddlewareInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CloggerTest extends TestCase
{
    public function testLog(): void
    {
        $level = 'error';
        $message = 'comsimple message';
        $context = ['simple' => 'context'];

        $logger = $this->prophesize(LoggerInterface::class);
        $logger->log($level, $message, $context)->shouldBeCalled();

        $middleware = $this->prophesize(MiddlewareInterface::class);
        $middleware->process($level, $message, $context)->willReturn([$message, $context])->shouldBeCalled();

        $clogger = new Clogger($logger->reveal(), $middleware->reveal());
        $clogger->log($level, $message, $context);
    }
}
