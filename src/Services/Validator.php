<?php

namespace Ls\ClientAssistant\Services;

use Ls\ClientAssistant\Helpers\Str;
use Respect\Validation\Validator as v;

class Validator
{
    private array $errors = [];
    private bool $ok = false;

    public static function login(array $data): self
    {
        $validator = new self();

        $isEmail = v::stringVal()->email()->validate(Str::toPersian($data['input']));
        $isMobile = v::numericVal()->regex('/((\+98|0)?9\d{9})|((\+)?\d{10,12})/')->validate(Str::toPersian($data['input']));

        if (!$isEmail and !$isMobile) {
            $validator->ok = false;
            $validator->errors[] = 'ورودی باید ایمیل یا موبایل باشد';

            return $validator;
        }

        if (isset($data['password'])) {
            $notBlankPassword = v::notBlank()->min(3)->validate(Str::toPersian($data['input']));
            if (!$notBlankPassword) {
                $validator->ok = false;
                $validator->errors[] = 'رمز عبور نباید خالی باشد';

                return $validator;
            }
        }

        $validator->ok = true;

        return $validator;
    }

    public static function verifyOtp($data): self
    {
        $validator = new self();

        $isEmail = v::stringVal()->email()->validate(Str::toPersian($data['input']));
        $isMobile = v::numericVal()->regex('/((\+98|0)?9\d{9})|((\+)?\d{10,12})/')->validate(Str::toPersian($data['input']));
        $isValidOtp = v::numericVal()->validate(Str::toPersian($data['input']));

        if (!$isEmail and !$isMobile) {
            $validator->ok = false;
            $validator->errors[] = 'ورودی باید ایمیل یا موبایل باشد';

            return $validator;
        }

        if (!$isValidOtp) {
            $validator->ok = false;
            $validator->errors[] = 'کد احراز هویت اجباری است';

            return $validator;
        }

        $validator->ok = true;
        return $validator;
    }

    public static function password($data): self
    {
        return new self();
    }

    public static function consultForm(): self
    {
        return new self();
    }

    public static function comment(): self
    {
        return new self();
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