<?php

declare(strict_types=1);

namespace Clogger\Tests\Middleware\Exception;

use Clogger\Middleware\Exception\ExceptionCodeMiddleware;
use PHPUnit\Framework\TestCase;

class ExceptionCodeMiddlewareTest extends TestCase
{
    /**
     * @dataProvider providerTestProcess
     *
     * @param mixed $message
     * @param mixed $expectedMessage
     */
    public function testProcess($message, array $context, $expectedMessage, array $expectedContext): void
    {
        $middleware = new ExceptionCodeMiddleware();
        [$newMessage, $newContext] = $middleware->process('doesnt matter', $message, $context);

        $this->assertEquals($expectedMessage, $newMessage);
        $this->assertEquals($expectedContext, $newContext);
    }

    /**
     * @see testProcess
     */
    public function providerTestProcess(): iterable
    {
        yield 'simple message' => ['message', ['extra_context' => 'test'], 'message', ['extra_context' => 'test']];

        $message = new \Exception('this is an exception', 100);
        yield 'exception message' => [$message, [], $message, ['code' => 100]];

        yield 'exception message with extra context' => [$message, ['extra_context' => 'test'], $message, ['extra_context' => 'test', 'code' => 100]];
    }
}
