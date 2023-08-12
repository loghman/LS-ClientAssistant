<?php

namespace Ls\ClientAssistant\Core\Enums;

class OrderByEnum
{
    public const MOST_VISITED = 'most_visited';
    public const MOST_COMMENTED = 'most_commented';
    public const MOST_EXPENSIVE = 'most_expensive';
    public const FIRST = 'asc';
    public const LATEST = 'desc';
    public const CHEAPEST = 'cheapest';

    public static function cases(): array
    {
        return [
            self::MOST_VISITED,
            self::MOST_COMMENTED,
            self::MOST_EXPENSIVE,
            self::FIRST,
            self::LATEST,
            self::CHEAPEST,
        ];
    }
}