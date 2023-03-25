<?php

namespace Ls\ClientAssistant\Core\Contracts;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

interface Filterable
{
    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection;
}