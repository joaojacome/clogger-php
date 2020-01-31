<?php

declare(strict_types=1);

namespace Clogger\Tests\Middleware\Exception;

use Clogger\Middleware\Exception\StackTraceMiddleware;
use PHPUnit\Framework\TestCase;

class StackTraceMiddlewareTest extends TestCase
{
    /**
     * @dataProvider providerTestProcess
     *
     * @param mixed $message
     * @param mixed $expectedMessage
     */
    public function testProcess($message, array $context, $expectedMessage, array $expectedContext, bool $shouldCheckTrace = false): void
    {
        $middleware = new StackTraceMiddleware();
        [$newMessage, $newContext] = $middleware->process('doesnt matter', $message, $context);

        $this->assertEquals($expectedMessage, $newMessage);
        if ($shouldCheckTrace) {
            $this->assertTrue(isset($newContext['stack_trace']));
            unset($newContext['stack_trace']);
        }
        $this->assertEquals($expectedContext, $newContext);
    }

    /**
     * @see testProcess
     */
    public function providerTestProcess(): iterable
    {
        yield 'nothing happens' => ['message', ['extra_context' => 'test'], 'message', ['extra_context' => 'test']];

        $message = new \Exception('this is an exception');
        yield 'exception message' => [$message, [], $message, [], true];

        yield 'exception message with extra context' => [$message, ['extra_context' => 'test'], $message, ['extra_context' => 'test'], true];
    }
}
