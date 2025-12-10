<?php

namespace Ls\ClientAssistant\Traits;

use Ls\ClientAssistant\Core\ActionDispatcher;
use Ls\ClientAssistant\Core\Enums\ActionType;

/**
 * Trait to add infrastructure dispatch capability to controllers
 */
trait DispatchesActions
{
    /**
     * Get the dispatcher instance
     */
    protected function getDispatcher(): ActionDispatcher
    {
        return ActionDispatcher::getInstance();
    }

    /**
     * Dispatch an action for an entity
     */
    protected function dispatchAction(
        string $entity, 
        ActionType|string $action, 
        array $params = [], 
        array $options = []
    ): mixed {
        return $this->getDispatcher()->dispatch($entity, $action, $params, $options);
    }

    /**
     * Dispatch an action asynchronously (won't block page load)
     */
    protected function dispatchActionAsync(
        string $entity, 
        ActionType|string $action, 
        array $params = []
    ): mixed {
        return $this->getDispatcher()->dispatchAsync($entity, $action, $params);
    }

    /**
     * Check if we can handle this entity action
     */
    protected function canDispatch(string $entity, ActionType|string $action): bool
    {
        return $this->getDispatcher()->canHandle($entity, $action);
    }

    // ============================================
    // Shortcut methods
    // ============================================

    protected function dispatchIndex(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->index($entity, $params, $options);
    }

    protected function dispatchShow(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->show($entity, $params, $options);
    }

    protected function dispatchCreate(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->create($entity, $params, $options);
    }

    protected function dispatchStore(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->store($entity, $params, $options);
    }

    protected function dispatchEdit(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->edit($entity, $params, $options);
    }

    protected function dispatchUpdate(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->update($entity, $params, $options);
    }

    protected function dispatchDelete(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->delete($entity, $params, $options);
    }

    protected function dispatchDestroy(string $entity, array $params = [], array $options = []): mixed
    {
        return $this->getDispatcher()->destroy($entity, $params, $options);
    }
}
