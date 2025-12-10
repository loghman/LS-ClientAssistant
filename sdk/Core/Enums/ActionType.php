<?php

namespace Ls\ClientAssistant\Core\Enums;

/**
 * Enum for different action types that can be performed on entities
 */
enum ActionType: string
{
    case INDEX = 'index';
    case SHOW = 'show';
    case CREATE = 'create';
    case STORE = 'store';
    case EDIT = 'edit';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case DESTROY = 'destroy';

    /**
     * Get all available action types
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
