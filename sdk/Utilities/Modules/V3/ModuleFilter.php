<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

#[\AllowDynamicProperties]
class ModuleFilter
{
    private string $includes = '';
    private string $excludes = '';
    private string $withCount = '';
    private string $search = '';
    private string $searchFields = '';
    private string $searchJoin = 'or';
    private string $orderBy = '';
    private string $sortedBy;
    private int $page;
    private int $per_page;

    public static function new()
    {
        return new self();
    }

    public function includes(... $relations): self
    {
        foreach ($relations as $relation) {
            $this->includes = $this->concat($this->includes, $relation);
        }

        return $this;
    }

    public function excludes(... $relations): self
    {
        foreach ($relations as $relation) {
            $this->excludes = $this->concat($this->excludes, $relation);
        }

        return $this;
    }

    public function withCounts(... $relations): self
    {
        foreach ($relations as $relation) {
            $this->withCount = $this->concat($this->withCount, $relation);
        }

        return $this;
    }

    public function search(string $column, mixed $value, string $operator = '='): self
    {
        $this->search = $this->concat($this->search, "$column:$value", ';');
        $this->searchFields = $this->concat($this->searchFields, "$column:$operator", ';');

        return $this;
    }

    public function searchJoin(string $and = 'and'): self
    {
        $this->searchJoin = $and;

        return $this;
    }

    public function orderBy(... $orderBys): self
    {
        foreach ($orderBys as $orderBy) {
            $this->orderBy = $this->concat($this->orderBy, $orderBy, ';');
        }

        return $this;
    }

    public function sortedBy(string $sortedBy): self
    {
        $this->sortedBy = $sortedBy;

        return $this;
    }

    public function page(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function perPage(int $perPage): self
    {
        $this->per_page = $perPage;

        return $this;
    }

    public function otherParams(string $column, mixed $value): self
    {
        $this->{$column} = $value;

        return $this;
    }

    private function concat(string $string, string $concat, string $separator = ','): string
    {
        if (empty($string)) {
            return $concat;
        }

        return $string.$separator.$concat;
    }

    public function all(): array
    {
        return array_filter(get_object_vars($this));
    }
}