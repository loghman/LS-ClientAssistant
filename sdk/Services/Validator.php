<?php

namespace Ls\ClientAssistant\Services;

use Ls\ClientAssistant\Helpers\Str;
use Respect\Validation\Validator as v;

class Validator
{
    private array $validatedData = [];
    private array $errors = [];
    private bool $ok = false;

    public static function login(array $data): self
    {
        $validator = new self();

        $input = Str::toEnglish($data['input']);
        $isEmail = v::stringVal()->email()->validate($input);
        $isMobile = v::numericVal()->regex('/((\+98|0)?9\d{9})|((\+)?\d{10,12})/')->validate($input);

        if (!$isEmail and !$isMobile) {
            $validator->ok = false;
            $validator->errors[] = 'ورودی باید ایمیل یا موبایل باشد';

            return $validator;
        }

        if ($isMobile) {
            if (!str_starts_with($input, '0')) {
                $input = '0' . $input;
            }

            $validator->validatedData['input'] = $input;
        }

        if (!$isMobile) {
            $validator->validatedData['input'] = $input;
        }

        if (isset($data['password'])) {
            $notBlankPassword = v::notBlank()->min(3)->validate(Str::toEnglish($data['password']));
            if (!$notBlankPassword) {
                $validator->ok = false;
                $validator->errors[] = 'رمز عبور نباید خالی باشد';

                return $validator;
            }

            $validator->validatedData['password'] = $data['password'];
        }

        $validator->ok = true;

        return $validator;
    }

    public static function verifyOtp($data): self
    {
        $validator = new self();

        $input = Str::toEnglish($data['input']);
        $isEmail = v::stringVal()->email()->validate($input);
        $isMobile = v::numericVal()->regex('/((\+98|0)?9\d{9})|((\+)?\d{10,12})/')->validate($input);
        $isValidOtp = v::numericVal()->validate(Str::toEnglish($data['otp']));

        if (!$isEmail and !$isMobile) {
            $validator->ok = false;
            $validator->errors[] = 'ورودی باید ایمیل یا موبایل باشد';

            return $validator;
        }

        if ($isMobile) {
            if (!str_starts_with($input, '0')) {
                $input = '0' . $input;
            }

            $validator->validatedData['input'] = $input;
        }

        if (!$isMobile) {
            $validator->validatedData['input'] = $input;
        }


        if (!$isValidOtp) {
            $validator->ok = false;
            $validator->errors[] = 'کد احراز هویت اجباری است';

            return $validator;
        }

        $validator->validatedData['otp'] = $data['otp'];
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
        return $this->errors;
    }

    public function ok(): bool
    {
        return $this->ok;
    }

    public function validatedData(): array
    {
        return $this->validatedData;
    }
}