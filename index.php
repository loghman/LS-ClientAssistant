<?php

include_once __DIR__ . "/vendor/autoload.php";


//['code', 'email']
print_r(\Ls\ClientAssistant\Utilities\Modules\User::get(1));
//print_r(\Ls\ClientAssistant\Utilities\Modules\User::list(['code', 'email'], [], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\User::search('isamirsalehi@gmail.com', ['code', 'email'], ['posts'], 100));


//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::get(11, ['comments']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::list(['comments'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::search('آمد', ['title', 'content'], ['comments'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\CMS::signal(1, \Ls\ClientAssistant\Core\Enums\CMSSignalEnum::VISIT, 1));

//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::get(1, ['items']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::list(['items', 100]));
//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::search('php-expert', ['title'], ['items'], 100));

//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::get(1, ['posts']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::list(['posts'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::search('hertha-gulgowski', ['slug'], ['posts'], 100));

//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::get(1));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::list());
//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::search('test'));

//print_r(\Ls\ClientAssistant\Utilities\Modules\Comment::getPostComments(5));