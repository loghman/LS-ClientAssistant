<?php

namespace Ls\ClientAssistant\Core;

use Ls\ClientAssistant\Core\Contracts\EntityHandlerInterface;
use Ls\ClientAssistant\Core\Enums\ActionType;

/**
 * Registry for entity action handlers
 * Stores and manages all registered handlers
 */
class ActionRegistry
{
    /**
     * Registered handlers indexed by entity name
     * 
     * @var array<string, EntityHandlerInterface>
     */
    private array $handlers = [];

    /**
     * Singleton instance
     */
    private static ?ActionRegistry $instance = null;

    /**
     * Get singleton instance
     */
    public static function getInstance(): ActionRegistry
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Register a handler for an entity
     */
    public function register(EntityHandlerInterface $handler): static
    {
        $entity = strtolower($handler->getEntity());
        $this->handlers[$entity] = $handler;

        return $this;
    }

    /**
     * Register multiple handlers at once
     * 
     * @param EntityHandlerInterface[] $handlers
     */
    public function registerMany(array $handlers): static
    {
        foreach ($handlers as $handler) {
            $this->register($handler);
        }

        return $this;
    }

    /**
     * Check if a handler exists for an entity
     */
    public function has(string $entity): bool
    {
        return isset($this->handlers[strtolower($entity)]);
    }

    /**
     * Check if a handler exists for an entity and supports an action
     */
    public function hasAction(string $entity, ActionType $action): bool
    {
        if (!$this->has($entity)) {
            return false;
        }

        return $this->get($entity)->supports($action);
    }

    /**
     * Get handler for an entity
     */
    public function get(string $entity): ?EntityHandlerInterface
    {
        return $this->handlers[strtolower($entity)] ?? null;
    }

    /**
     * Get all registered handlers
     * 
     * @return array<string, EntityHandlerInterface>
     */
    public function all(): array
    {
        return $this->handlers;
    }

    /**
     * Get all registered entity names
     * 
     * @return string[]
     */
    public function entities(): array
    {
        return array_keys($this->handlers);
    }

    /**
     * Remove a handler for an entity
     */
    public function remove(string $entity): static
    {
        unset($this->handlers[strtolower($entity)]);

        return $this;
    }

    /**
     * Clear all handlers
     */
    public function clear(): static
    {
        $this->handlers = [];

        return $this;
    }
}
