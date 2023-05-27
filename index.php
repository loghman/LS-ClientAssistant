<?php

include_once __DIR__ . "/vendor/autoload.php";

use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;

$userToken = '1|rKXl2ejyT9hkEy40XuaNXiVhagXYBsHUtRt5zUHY';

//print_r(User::stats($userToken));
//print_r(User::updatePassword('password', 'newpassword', 'newpassword', $userToken));
//print_r(User::uploadResumeBanner('{}', $userToken));

//print_r(Enrollment::logs(1, $userToken));
//print_r(Enrollment::signal(1, 1, 'visited', $userToken));

//print_r(LMSProduct::chapters(1));
//print_r(LMSProduct::chapterStats(2, 1, $userToken));
