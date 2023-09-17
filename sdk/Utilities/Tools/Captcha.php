<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Anhskohbo\NoCaptcha\NoCaptcha;

class Captcha
{
    public static function verify($response)
    {
        $captcha = new NoCaptcha(setting('_env_google_recaptcha_v3_secret_key'), setting('_env_google_recaptcha_v3_site_key'));

        return $captcha->verifyResponse($response);
    }
}