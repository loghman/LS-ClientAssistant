<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Token
{
    private ?string $token;
    private string $cookieName;
    private int $ttl;

    public static function token(string $token = null, string $cookieName = 'token'): self
    {
        $self = new self();
        $self->token = $token;
        $self->cookieName = $cookieName;
        $self->days();

        return $self;
    }

    public function save(): void
    {
        if ($this->token) {
            $this->remove();
            setcookie($this->cookieName, $this->token, time() + $this->ttl, '/', get_cookie_domain(), is_production_environment());
        }
    }

    public function remove(): void
    {
        setcookie($this->cookieName, '', time() - 3600, '/', get_cookie_domain(), is_production_environment());
    }

    public function seconds(int $seconds = 1): self
    {
        $this->ttl = $seconds;

        return $this;
    }

    public function minutes(int $minutes = 1): self
    {
        $this->ttl = 60 * $minutes;

        return $this;
    }

    public function hours(int $hours = 1): self
    {
        $this->ttl = 60 * 60 * $hours;

        return $this;
    }

    public function days(int $days = 1): self
    {
        $this->ttl = 60 * 60 * 24 * $days;

        return $this;
    }

    public function weeks(int $weeks = 1): self
    {
        $this->ttl = 60 * 60 * 24 * 7;

        return $this;
    }
}