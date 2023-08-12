<?php

namespace Ls\ClientAssistant\Helpers;

class View
{
    public static function fullAddress(string $view, $viewAddress): string
    {
        return $viewAddress . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}