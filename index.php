<?php

include_once __DIR__ . "/vendor/autoload.php";


//print_r(\Ls\ClientAssistant\Utilities\Modules\User::getUser(1, ['code', 'email']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\User::getUsers(['code', 'email'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\User::search('isamirsalehi@gmail.com', ['code', 'email'], ['posts'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\User::filter(['is_blocked' => 0], ['posts'], 100, \Ls\ClientAssistant\Core\Enums\OrderByEnum::LATEST));


//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::getPost(11, ['comments']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::getPosts(['comments'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::search('آمد', ['title', 'content'], ['comments'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::filter(['author_id' => 1], ['comments'], 100, \Ls\ClientAssistant\Core\Enums\OrderByEnum::LATEST));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::signal(1, \Ls\ClientAssistant\Core\Enums\CMSSignalEnum::VISIT, 1));