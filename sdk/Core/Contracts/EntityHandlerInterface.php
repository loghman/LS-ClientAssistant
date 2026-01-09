<?php

namespace Ls\ClientAssistant\Core\Contracts;

use Ls\ClientAssistant\Core\Enums\ActionType;

/**
 * Contract for entity action handlers
 */
interface EntityHandlerInterface
{
    /**
     * Get the entity name this handler is responsible for
     */
    public function getEntity(): string;

    /**
     * Get supported actions for this entity
     * 
     * @return ActionType[]
     */
    public function getSupportedActions(): array;

    /**
     * Check if this handler supports a specific action
     */
    public function supports(ActionType $action): bool;

    /**
     * Execute the handler for a specific action
     * 
     * @param ActionType $action The action to execute
     * @param array $params Parameters passed to the handler
     * @param array $options Additional options (e.g., async)
     * @return mixed
     */
    public function handle(ActionType $action, array $params = [], array $options = []): mixed;

    /**
     * Check if this action should be executed asynchronously
     */
    public function isAsync(ActionType $action): bool;
}
