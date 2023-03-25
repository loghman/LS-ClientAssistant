<?php

namespace Ls\ClientAssistant\Core\Contracts;

use Illuminate\Support\Collection;

interface Filterable
{
    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = 'latest'): Collection;
}