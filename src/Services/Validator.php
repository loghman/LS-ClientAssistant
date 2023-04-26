<?php

namespace Ls\ClientAssistant\Services;

use Respect\Validation\Validator as v;

class Validator
{
    private array $errors = [];
    private bool $ok = false;

    public static function login(array $data): self
    {
        $validator = new self();

        $isEmail = v::stringVal()->email()->validate($data['input']);
        $isMobile = v::numericVal()->regex('/((\+98|0)?9\d{9})|((\+)?\d{10,12})/')->validate($data['input']);

        if (!$isEmail and !$isMobile) {
            $validator->ok = false;
            $validator->errors[] = 'ورودی باید ایمیل یا موبایل باشد';

            return $validator;
        }

        if (isset($data['password'])) {
            $notBlankPassword = v::notBlank()->min(3)->validate($data['password']);
            if (!$notBlankPassword) {
                $validator->ok = false;
                $validator->errors[] = 'رمز عبور نباید خالی باشد';

                return $validator;
            }
        }

        $validator->ok = true;

        return $validator;
    }

    public static function verifyOtp()
    {

    }

    public static function validatePassword()
    {

    }

    public function errors(): array
    {
        return [];
    }

    public function ok(): bool
    {
        return true;
    }

}