<?php

namespace Ls\ClientAssistant\Handlers;

use Ls\ClientAssistant\Core\Contracts\EntityHandlerInterface;
use Ls\ClientAssistant\Core\Enums\ActionType;

/**
 * Abstract base handler for entities
 * Extend this class to create handlers for specific entities
 */
abstract class BaseEntityHandler implements EntityHandlerInterface
{
    /**
     * Configuration for async actions
     * Override in child classes to specify which actions should be async
     * 
     * @var array<string, bool>
     */
    protected array $asyncActions = [];

    /**
     * Default async behavior for all actions
     */
    protected bool $defaultAsync = false;

    /**
     * Get the entity name this handler is responsible for
     */
    abstract public function getEntity(): string;

    /**
     * Get supported actions for this entity
     * Override this to limit which actions are supported
     * 
     * @return ActionType[]
     */
    public function getSupportedActions(): array
    {
        return ActionType::cases();
    }

    /**
     * Check if this handler supports a specific action
     */
    public function supports(ActionType $action): bool
    {
        $methodName = $this->getMethodName($action);
        
        return method_exists($this, $methodName) 
            && in_array($action, $this->getSupportedActions());
    }

    /**
     * Execute the handler for a specific action
     */
    public function handle(ActionType $action, array $params = [], array $options = []): mixed
    {
        if (!$this->supports($action)) {
            return null;
        }

        $methodName = $this->getMethodName($action);

        // Check if should run async
        $runAsync = $options['async'] ?? $this->isAsync($action);

        if ($runAsync) {
            return $this->executeAsync($methodName, $params);
        }

        return $this->$methodName($params);
    }

    /**
     * Check if this action should be executed asynchronously
     */
    public function isAsync(ActionType $action): bool
    {
        return $this->asyncActions[$action->value] ?? $this->defaultAsync;
    }

    /**
     * Set async configuration for specific action
     */
    public function setAsync(ActionType $action, bool $async = true): static
    {
        $this->asyncActions[$action->value] = $async;
        return $this;
    }

    /**
     * Get method name for an action
     */
    protected function getMethodName(ActionType $action): string
    {
        return 'on' . ucfirst($action->value);
    }

    /**
     * Execute method asynchronously
     * This is a placeholder - implement actual async logic based on your needs
     */
    protected function executeAsync(string $method, array $params): mixed
    {
        // Default implementation: schedule for deferred execution
        // This won't block the page load
        register_shutdown_function(function () use ($method, $params) {
            // Ignore user abort to continue execution
            ignore_user_abort(true);
            
            // Flush output to browser
            if (function_exists('fastcgi_finish_request')) {
                fastcgi_finish_request();
            }

            // Execute the actual method
            $this->$method($params);
        });

        return [
            'status' => 'queued',
            'async' => true,
            'method' => $method,
        ];
    }

    // ============================================
    // Override these methods in child classes
    // ============================================

    /**
     * Handle index action - list entities
     */
    protected function onIndex(array $params): mixed
    {
        return null;
    }

    /**
     * Handle show action - show single entity
     */
    protected function onShow(array $params): mixed
    {
        return null;
    }

    /**
     * Handle create action - show create form
     */
    protected function onCreate(array $params): mixed
    {
        return null;
    }

    /**
     * Handle store action - store new entity
     */
    protected function onStore(array $params): mixed
    {
        return null;
    }

    /**
     * Handle edit action - show edit form
     */
    protected function onEdit(array $params): mixed
    {
        return null;
    }

    /**
     * Handle update action - update entity
     */
    protected function onUpdate(array $params): mixed
    {
        return null;
    }

    /**
     * Handle delete action - show delete confirmation
     */
    protected function onDelete(array $params): mixed
    {
        return null;
    }

    /**
     * Handle destroy action - actually delete entity
     */
    protected function onDestroy(array $params): mixed
    {
        return null;
    }
}
