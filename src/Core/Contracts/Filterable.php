<?php

namespace Ls\ClientAssistant\Core\Contracts;

interface Filterable
{
    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = 'latest');
}