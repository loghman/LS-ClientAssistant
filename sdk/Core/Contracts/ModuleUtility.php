<?php

namespace Ls\ClientAssistant\Core\Contracts;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

abstract class ModuleUtility
{
    abstract public static function get(string $idOrSlug, array $with = []): Collection;

    abstract public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection;

    abstract public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection;
}