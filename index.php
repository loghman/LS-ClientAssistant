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

//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::getProduct(1, ['items']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::getProducts(['items', 100]));
//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::search('php-expert', ['title'], ['items'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\LMS::filter(['age_range' => 'adult'], ['items'], 100, \Ls\ClientAssistant\Core\Enums\OrderByEnum::LATEST));

//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::getTerm(1, ['posts']));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::getTerms(['posts'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::search('hertha-gulgowski', ['slug'], ['posts'], 100));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Term::filter(['type' => 'tag'], ['posts'], 100, \Ls\ClientAssistant\Core\Enums\OrderByEnum::LATEST));

//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::getSurvey(1));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::getSurveys());
//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::search('test'));
//print_r(\Ls\ClientAssistant\Utilities\Modules\Survey::filter(['type' => 1]));

print_r(\Ls\ClientAssistant\Utilities\Modules\Comment::getPostComments(5));