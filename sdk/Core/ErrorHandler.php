<?php

namespace Ls\ClientAssistant\Core;

use ErrorException;

class ErrorHandler
{
    /**
     * register errors handlers
     * now we support Sentry
     *
     * @return void
     */
    public static function register(): void
    {
        $sentryStatus = false;
        if (!empty(env('SENTRY_DSN'))) {
            \Sentry\init([
                'dsn'            => env('SENTRY_DSN'),
                'environment'    => env('APP_ENV'),
                'enable_tracing' => true,
            ]);

            $sentryStatus = true;
        }

        set_error_handler(
            function ($level, $error, $file, $line) use ($sentryStatus) {
                $error = new ErrorException($error, -1, $level, $file, $line);

                if ($sentryStatus) {
                    \Sentry\captureException($error);
                }

                // TODO: need check and improvement
                // if (1 === error_reporting()) {
                //     throw $error;
                // }
            },
            E_ALL
        );

        register_shutdown_function(function () use ($sentryStatus) {
            $error = error_get_last();
            if ($error) {
                $error = new ErrorException($error['message'], -1, $error['type'], $error['file'], $error['line']);
                if ($sentryStatus) {
                    \Sentry\captureException($error);
                }

                // TODO: need check and improvement
                // if (1 === error_reporting()) {
                //     throw $error;
                // }
            }
        });

        set_exception_handler(function ($exception) use ($sentryStatus) {
            if ($sentryStatus) {
                \Sentry\captureException($exception);
            }

            if(env('APP_DEBUG') || env('APP_ENV') == 'local') {
                dd($exception);
            }
            
            throw $exception;
        });
    }
}
