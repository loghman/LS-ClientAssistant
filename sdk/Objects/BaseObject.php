<?php

namespace Ls\ClientFramework\Objects;

abstract class BaseObject
{
    protected function __construct(protected array $resource)
    {
    }

    public static function new(array|\stdClass $resource): self
    {
        if ($resource instanceof \stdClass) {
            $resource = (array)$resource;
        }
        return new static($resource);
    }

    abstract protected function maps(): array;

    public function values(...$args): array
    {
        $items = [];
        foreach ($args as $arg) {
            $alias = $arg;
            if (array_key_exists($arg, $this->maps())) {
                $alias = $this->maps()[$arg];
            }
            $items[$alias] = $this->value($arg);
        }

        return $items;
    }

    public function value($arg): mixed
    {
        $method = $this->camelCase($arg);
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        return data_get($this->resource, $arg);
    }

    protected function camelCase(string $input): string
    {
        return \lcfirst(\str_replace('_', '', \ucwords($input, '_')));
    }
}