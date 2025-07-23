<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class ArrayHelper
{
    public static function add(array &$array, array $additions): void
    {
        foreach ($additions as $key => $value) {
            $array[$key] = $value;
        }
    }

    public static function update(array &$array, array $updates): void
    {
        foreach ($updates as $key => $value) {
            if (array_key_exists($key, $array)) {
                $array[$key] = $value;
            }
        }
    }

    public static function rename(array &$array, array $renames): void
    {
        foreach ($renames as $oldKey => $newKey) {
            if (array_key_exists($oldKey, $array)) {
                $array[$newKey] = $array[$oldKey];
                unset($array[$oldKey]);
            }
        }
    }

    public static function delete(array &$array, array $keys): void
    {
        foreach ($keys as $key) {
            unset($array[$key]);
        }
    }
} 