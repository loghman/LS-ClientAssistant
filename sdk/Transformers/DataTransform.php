<?php

namespace Ls\ClientAssistant\Transformers;

use Illuminate\Contracts\Support\Arrayable;

class DataTransform implements Arrayable, \Iterator
{
    private int $position = 0;
    private ?string $url = null;

    public function __construct(private array|\stdClass $data, private ?array $meta = null)
    {
    }

    public function setNextPageUrl(string $url): self
    {
        $this->url = $this->updateQueryParam($url, ['page' => $this->nextPage(), 'per_page' => $this->perPage()]);

        return $this;
    }

    public function nextPageUrl(): string
    {
        if ($this->url) {
            return $this->url;
        }

        return $this->updateQueryParam(request()->fullUrl(), 'page', $this->nextPage());
    }

    public function totalPage(): ?int
    {
        return $this->meta['pagination']['total_pages'] ?? 0;
    }

    public function hasMorePaginate(): bool
    {
        return ! empty($this->meta) && $this->nextPage() <= $this->totalPage();
    }

    public function total(): int
    {
        return $this->meta['pagination']['total'] ?? 0;
    }

    public function count(): int
    {
        return $this->meta['pagination']['count'] ?? 0;
    }

    public function currentPage(): int
    {
        return $this->meta['pagination']['current_page'] ?? 1;
    }

    public function nextPage(): int
    {
        return $this->meta['pagination']['current_page'] + 1 ?? 1;
    }

    public function perPage(): int
    {
        return $this->meta['pagination']['per_page'] ?? 15;
    }

    public function __get(string $name)
    {
        return data_get($this->data, $name);
    }

    public function toArray()
    {
        return $this->data;
    }

    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    private function updateQueryParam($url, $key, $value = null): string
    {
        if (! is_array($key)) {
            $key = [$key => $value];
        }
        $params = parse_url($url, PHP_URL_QUERY);

        $queryParams = [];
        if (isset($params)) {
            parse_str($params, $queryParams);
        }

        foreach ($key as $k => $v) {
            $queryParams[$k] = $v;
        }

        $newQueryString = http_build_query($queryParams);

        return strtok($url, '?').'?'.$newQueryString;
    }
}