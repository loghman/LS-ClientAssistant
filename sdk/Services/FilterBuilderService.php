<?php

namespace Ls\ClientAssistant\Services;

use InvalidArgumentException;

class FilterBuilderService
{
    private array $filters = ['searchJoin' => 'and'];

    public function __construct(private ?string $baseUrl = null){}

    private function validateField(string $field): void
    {
        if (empty(trim($field))) {
            throw new InvalidArgumentException("Field name must be a non-empty string.");
        }
    }

    private function validateValue(mixed $value): void
    {
        if ($value === null) {
            throw new InvalidArgumentException("Value cannot be null.");
        }
    }

    public function addRangeFilter(string $field, float $min, float $max): self
    {
        $this->validateField($field);
        $this->filters['search'][] = "{$field}:{$min},{$max}";
        $this->filters['searchFields'][] = "{$field}:between";
        return $this;
    }

    public function addMultipleValueFilter(string $field, array $values): self
    {
        $this->validateField($field);
        if (empty($values)) {
            throw new InvalidArgumentException("Values must be a non-empty array.");
        }
        $this->filters['search'][] = "{$field}:".implode(',', $values);
        $this->filters['searchFields'][] = "{$field}:in";
        return $this;
    }

    public function addComparisonFilter(string $field, string $operator, mixed $value): self
    {
        $this->validateField($field);
        $this->validateValue($value);
        if (! in_array($operator, ['>', '<', '>=', '<=', '=', '!='], true)) {
            throw new InvalidArgumentException("Invalid comparison operator.");
        }
        $this->filters['search'][] = "{$field}:{$value}";
        $this->filters['searchFields'][] = "{$field}:{$operator}";
        return $this;
    }

    public function addSearchFilter(string $field, mixed $value): self
    {
        $this->validateField($field);
        $this->validateValue($value);
        $this->filters['search'][] = "{$field}:{$value}";
        $this->filters['searchFields'][] = "{$field}:like";
        return $this;
    }

    public function hasRelatedWithRangeFilter(string $relation, string $field, float $min, float $max): self
    {
        $this->addRangeFilter("$relation.$field", $min, $max);
        return $this;
    }

    public function hasRelatedWithMultipleValueFilter(string $relation, string $field, array $values): self
    {
        $this->addMultipleValueFilter("$relation.$field", $values);
        return $this;
    }

    public function hasRelatedWithComparisonFilter(string $relation, string $field, string $operator, mixed $value): self
    {
        $this->addComparisonFilter("$relation.$field", $operator, $value);
        return $this;
    }

    public function hasRelatedWithSearchFilter(string $relation, string $field, mixed $value): self
    {
        $this->addSearchFilter("$relation.$field", $value);
        return $this;
    }

    public function addSort(string $field, string $direction): self
    {
        $this->validateField($field);

        if (! in_array($direction, ['asc', 'desc'], true)) {
            throw new InvalidArgumentException("Sort direction must be either 'asc' or 'desc'.");
        }
        $this->filters['orderBy'][] = $field;
        $this->filters['sortedBy'][] = $direction;
        return $this;
    }

    public function includeRelation(array $relations): self
    {
        if (empty($relations)) {
            throw new InvalidArgumentException("relations must be a none-empty array.");
        }
        $this->filters['includes'] = implode(',', $relations);
        return $this;
    }

    public function excludeRelation(array $relations): self
    {
        if (empty($relations)) {
            throw new InvalidArgumentException("relations must be a none-empty array.");
        }
        $this->filters['excludes'] = implode(',', $relations);
        return $this;
    }

    public function withCountRelation(array $relations): self
    {
        if (empty($relations)) {
            throw new InvalidArgumentException("relations must be a none-empty array.");
        }
        $this->filters['withCount'] = implode(',', $relations);
        return $this;
    }

    public function setPage(int $page): self
    {
        if ($page < 1) {
            throw new InvalidArgumentException("page must be positive integers.");
        }
        $this->filters['page'] = $page;
        return $this;
    }

    public function setPerPage(int $perPage): self
    {
        if ($perPage < 1) {
            throw new InvalidArgumentException("per page must be positive integers.");
        }
        $this->filters['per_page'] = $perPage;
        return $this;
    }

    public function setOrJoin(): self
    {
        $this->filters['searchJoin'] = 'or';
        return $this;
    }

    public function otherParams(string $field, mixed $value): self
    {
        $this->filters[$field] = $value;
        return $this;
    }

    public function getFilters(): array
    {
        $filters = [];
        foreach ($this->filters as $key => $value) {
            if (is_array($value) && in_array($key, ['search', 'searchFields', 'orderBy', 'sortedBy'])) {
                $value = $this->implodeValues($value , $key);
            }
            $filters[$key] = $value;
        }

        return $filters;
    }

    private function implodeValues(array $values, string $key): string
    {
        if (empty($values)) {
            return '';
        }

        if ($key === 'sortedBy') {
            return count($values) > 1 ? implode(';', $values) : implode('', $values);
        }

        return implode(';', $values) . ';';
    }

    public function buildUrl(): string
    {
        $queryParams= http_build_query($this->getFilters(),'','&',PHP_QUERY_RFC3986);

        return "{$this->baseUrl}?{$queryParams}";
    }
}
