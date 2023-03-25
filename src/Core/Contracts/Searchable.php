<?php

namespace Ls\ClientAssistant\Core\Contracts;

use Illuminate\Support\Collection;

interface Searchable
{
    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection;
}