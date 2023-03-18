<?php


function initGuzzle()
{
    return new GuzzleHttp\Client();
}

function config(string $key)
{
    $keys = explode('.', $key);

    $configDirectoryPath = __DIR__ . '/configs/';

    if (!isset($keys[0])) {
        return false;
    }

    if (file_exists($configDirectoryPath . $keys[0])) {
        return false;
    }

    $configFile = include $configDirectoryPath . $keys[0] . '.php';

    unset($keys[0]);

    return getArrayValue($configFile, $keys);
}

function view(string $view, $viewAddress)
{
    return $viewAddress . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view);
}


function getArrayValue(array $array, array $indexes)
{
    if (count($array) == 0 || count($indexes) == 0) {
        return false;
    }

    $index = array_shift($indexes);
    if (!array_key_exists($index, $array)) {
        return false;
    }

    $value = $array[$index];
    if (count($indexes) == 0) {
        return $value;
    }

    if (!is_array($value)) {
        return false;
    }

    return getArrayValue($value, $indexes);
}