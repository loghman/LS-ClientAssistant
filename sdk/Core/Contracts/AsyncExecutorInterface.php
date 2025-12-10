<?php

namespace Ls\ClientAssistant\Core\Contracts;

/**
 * Contract for async execution capability
 */
interface AsyncExecutorInterface
{
    /**
     * Execute a callable asynchronously (non-blocking)
     * 
     * @param callable $callback The callback to execute
     * @param array $params Parameters to pass to callback
     * @return void
     */
    public function executeAsync(callable $callback, array $params = []): void;

    /**
     * Queue a task for later execution
     * 
     * @param string $handler Handler class name
     * @param string $method Method to call
     * @param array $params Parameters to pass
     * @return string Job ID
     */
    public function queue(string $handler, string $method, array $params = []): string;
}
