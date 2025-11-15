<?php

namespace Ls\ClientFramework\Objects;

class Review extends BaseObject
{
    protected function maps(): array
    {
        return [
            'comment' => 'comment',
            'rate.to_persian' => 'title',
            'rate.to_emoji' => 'emoji_url',
            'created_at.jalali.human' => 'created_at',
        ];
    }

    public function user(string $key): array
    {
        return User::new($this->resource['user'])->values($key);
    }
}