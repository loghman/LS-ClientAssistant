<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Token
{
    private bool $setCookie = false;
    private string $token;
    private string $cookieName;

    public static function token(string $token = '', string $cookieName = 'token'): self
    {
        $self = new self();
        $self->token = $token;
        $self->cookieName = $cookieName;

        return $self;
    }

    public function remove(): void
    {
        setcookie('token', '', time() - 3600, '/', ($domain = get_cookie_domain()), (bool) $domain);
    }

    public function setCookie(): self
    {
        $this->setCookie = true;

        return $this;
    }

    public function seconds(int $seconds = 1): self
    {
        if ($this->setCookie && $this->token) {
            setcookie($this->cookieName, $this->token, time() + $seconds, '/', ($domain = get_cookie_domain()), (bool) $domain);
        }

        return $this;
    }

    public function minutes(int $minutes = 1): self
    {
        if ($this->setCookie && $this->token) {
            setcookie($this->cookieName, $this->token, time() + (60 * $minutes), '/', ($domain = get_cookie_domain()), (bool) $domain);
        }

        return $this;
    }

    public function hours(int $hours = 1): self
    {
        if ($this->setCookie && $this->token) {
            setcookie($this->cookieName, $this->token, time() + 60 * 60 * $hours, '/', ($domain = get_cookie_domain()), (bool) $domain);
        }

        return $this;
    }

    public function days(int $days = 1): self
    {
        if ($this->setCookie && $this->token) {
            setcookie($this->cookieName, $this->token, time() + 60 * 60 * 24 * $days, '/', ($domain = get_cookie_domain()), (bool) $domain);
        }

        return $this;
    }

    public function weeks(int $weeks = 1): self
    {
        if ($this->setCookie && $this->token) {
            setcookie($this->cookieName, $this->token, time() + 60 * 60 * 24 * 7 * $weeks, '/', ($domain = get_cookie_domain()), (bool) $domain);
        }

        return $this;
    }
}