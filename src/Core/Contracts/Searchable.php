<?php

namespace Ls\ClientAssistant\Core\Contracts;

interface Searchable
{
    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20);
}