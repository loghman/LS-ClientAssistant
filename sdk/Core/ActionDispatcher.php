<?php

namespace Ls\ClientAssistant\Core;

use Ls\ClientAssistant\Core\Contracts\EntityHandlerInterface;
use Ls\ClientAssistant\Core\Enums\ActionType;

/**
 * Main dispatcher for entity actions
 * Use this class to dispatch actions from controllers
 */
class ActionDispatcher
{
    private ActionRegistry $registry;

    /**
     * Singleton instance
     */
    private static ?ActionDispatcher $instance = null;

    public function __construct(?ActionRegistry $registry = null)
    {
        $this->registry = $registry ?? ActionRegistry::getInstance();
    }

    /**
     * Get singleton instance
     */
    public static function getInstance(): ActionDispatcher
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Dispatch an action for an entity
     * 
     * @param string $entity Entity name (e.g., 'post', 'user')
     * @param ActionType|string $action Action to perform
     * @param array $params Parameters to pass to handler
     * @param array $options Additional options (e.g., ['async' => true])
     * @return mixed Result from handler or null if no handler found
     */
    public function dispatch(
        string $entity, 
        ActionType|string $action, 
        array $params = [], 
        array $options = []
    ): mixed {
        // Convert string action to ActionType
        if (is_string($action)) {
            $action = ActionType::from(strtolower($action));
        }

        // Check if handler exists for this entity
        if (!$this->registry->has($entity)) {
            return null;
        }

        $handler = $this->registry->get($entity);

        // Check if handler supports this action
        if (!$handler->supports($action)) {
            return null;
        }

        // Execute the handler
        return $handler->handle($action, $params, $options);
    }

    /**
     * Dispatch an action asynchronously
     * Shortcut for dispatch with async option
     */
    public function dispatchAsync(
        string $entity, 
        ActionType|string $action, 
        array $params = []
    ): mixed {
        return $this->dispatch($entity, $action, $params, ['async' => true]);
    }

    /**
     * Check if an entity has a handler registered
     */
    public function hasHandler(string $entity): bool
    {
        return $this->registry->has($entity);
    }

    /**
     * Check if an entity supports a specific action
     */
    public function canHandle(string $entity, ActionType|string $action): bool
    {
        if (is_string($action)) {
            $action = ActionType::tryFrom(strtolower($action));
            if ($action === null) {
                return false;
            }
        }

        return $this->registry->hasAction($entity, $action);
    }

    /**
     * Register a handler
     */
    public function register(EntityHandlerInterface $handler): static
    {
        $this->registry->register($handler);

        return $this;
    }

    /**
     * Get the registry instance
     */
    public function getRegistry(): ActionRegistry
    {
        return $this->registry;
    }

    // ============================================
    // Shortcut methods for common actions
    // ============================================

    /**
     * Dispatch index action
     */
    public function index(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::INDEX, $params, $options);
    }

    /**
     * Dispatch show action
     */
    public function show(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::SHOW, $params, $options);
    }

    /**
     * Dispatch create action
     */
    public function create(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::CREATE, $params, $options);
    }

    /**
     * Dispatch store action
     */
    public function store(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::STORE, $params, $options);
    }

    /**
     * Dispatch edit action
     */
    public function edit(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::EDIT, $params, $options);
    }

    /**
     * Dispatch update action
     */
    public function update(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::UPDATE, $params, $options);
    }

    /**
     * Dispatch delete action
     */
    public function delete(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::DELETE, $params, $options);
    }

    /**
     * Dispatch destroy action
     */
    public function destroy(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->dispatch($entity, ActionType::DESTROY, $params, $options);
    }
}
