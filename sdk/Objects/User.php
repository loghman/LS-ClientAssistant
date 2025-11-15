<?php

namespace Ls\ClientFramework\Objects;

class User extends BaseObject
{
    protected function maps(): array
    {
        return [
            'full_name' => 'name',
            'avatar_medium_url' => 'avatar_url',
            'avatar_main_url' => 'avatar_url',
        ];
    }

    public function avatarMainUrl(): ?string
    {
        return get_media_url($this->resource['avatar'], get_default_media(\Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum::AVATAR));
    }

    public function avatarMediumUrl(): ?string
    {
        return get_media_url($this->resource['avatar'], get_default_media(\Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum::AVATAR));
    }
}