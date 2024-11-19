<?php

namespace Ls\ClientAssistant\Transformers;

use Illuminate\Support\Collection;

abstract class BaseTransformer
{
    protected object $resource;
    protected static array $collection;

    protected function __construct(array|object $resource)
    {
        if (is_array($resource)) {
            $resource = (object) $resource;
        }
        $this->resource = $resource;
    }

    abstract public function transform(): array;

    protected function resolve(?int $count = null, ?int $index = null): object
    {
        return $this->recursive($this->transform($count, $index));
    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
        return $this->resource->{$name};
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            $this->{$name}($arguments);
        }
        return $this->resource->{$name}(...$arguments);
    }

    public static function collection(Collection $data): DataTransform
    {
        $meta = $data->get('meta');
        self::$collection = $data = $data->get('data');
        $data = array_map(fn ($item, $index) => (new static($item))->resolve(count($data), $index), $data, array_keys($data));

        return (new DataTransform($data, $meta));
    }

    public static function item(Collection $data, ...$args): DataTransform
    {
        $data = (new static($data->get('data'), ...$args))->resolve();

        return (new DataTransform($data));
    }

    private function recursive($array): object
    {
        return (object) array_map(function ($value) {
            if (is_array($value)) {
                return $this->recursive($value);
            }

            return $value;
        }, $array);
    }
}