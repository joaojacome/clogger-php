<?php

declare(strict_types=1);

namespace Clogger\Tests\Middleware\Context;

use Clogger\ContextualInterface;
use Clogger\Middleware\Context\ContextMiddleware;
use PHPUnit\Framework\TestCase;

class ContextMiddlewareTest extends TestCase
{
    /**
     * @dataProvider providerTestProcess
     *
     * @param mixed $message
     * @param mixed $expectedMessage
     */
    public function testProcess($message, array $context, $expectedMessage, array $expectedContext): void
    {
        $contextMiddleware = new ContextMiddleware();
        [$newMessage, $newContext] = $contextMiddleware->process('doesnt matter', $message, $context);

        $this->assertEquals($expectedMessage, $newMessage);
        $this->assertEquals($expectedContext, $newContext);
    }

    /**
     * @see testProcess
     */
    public function providerTestProcess(): iterable
    {
        yield 'simple message' => ['message', ['extra_context' => 'test'], 'message', ['extra_context' => 'test']];

        $message = new class() implements ContextualInterface {
            public function getContext(): array
            {
                return ['extra_context' => 'test'];
            }
        };

        yield 'message with context' => [$message, [], $message, ['extra_context' => 'test']];
    }
}
