<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaCollectionEnum;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum;

class Media
{
    public static function getMediaUrl(?array $media, string $defaultMedia = '', string $conversion = MediaConversionEnum::ORIGINAL): string
    {
        if (!self::isValidMedia($media)) {
            return $defaultMedia;
        }

        if ($conversion === MediaConversionEnum::ORIGINAL) {
            return $media['url'];
        }

        if (in_array($media['collection_name'], MediaCollectionEnum::getImageConversionableCollections())) {
            return $media[$conversion]['url'] ?? $media['url'];
        }

        return $media['url'];
    }

    private static function isValidMedia(?array $media): bool
    {
        return !empty($media) && isset($media['collection_name']) && isset($media['url']);
    }

    public static function getDefaultMedia(string $mediaDefaultReplacement): string
    {
        $defaultMedia = Config::get('media.default_replacements.' . $mediaDefaultReplacement);

        if (!$defaultMedia) {
            return '';
        }

        return is_valid_url($defaultMedia) ? $defaultMedia : asset_url($defaultMedia);
    }
}