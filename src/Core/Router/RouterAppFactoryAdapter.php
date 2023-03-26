<?php

namespace Ls\ClientAssistant\Core\Router;

use Slim\Factory\AppFactory;

class RouterAppFactoryAdapter extends AppFactory
{
    public string $apikey;

    public function setApiKey(string $apikey)
    {
        $GLOBALS['apikey'] = $apikey;
        $this->apikey = $apikey;
    }

    public function getApiKey(): string
    {
        return $this->apikey;
    }
}