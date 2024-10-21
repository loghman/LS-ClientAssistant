<?php

namespace Ls\ClientAssistant\Exceptions;

class UnprocessableContent extends \Exception
{
    public static function instance(string $message): self
    {
        return new self($message);
    }
}