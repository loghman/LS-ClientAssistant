<?php

namespace Ls\ClientAssistant\Utilities\Tools\Enums;

class MediaCollectionEnum
{
    public const IMAGES              = 'images';
    public const IMAGE               = 'image';
    public const LOGO                = 'logo';
    public const BANNER              = 'banner';
    public const AVATAR              = 'avatar';
    public const VIDEOS              = 'videos';
    public const VIDEO               = 'video';
    public const GALLERY             = 'gallery';
    public const DOCUMENTS           = 'documents';
    public const DOCUMENT            = 'document';
    public const ATTACHMENT          = 'attachment';
    public const ATTACHMENTS         = 'attachments';
    public const AUDIOS              = 'audios';
    public const AUDIO               = 'audio';
    public const ARCHIVES            = 'archives';
    public const DEFAULT             = 'default';
    public const MEDIA               = 'media';
    public const SUPPORT             = 'support';
    public const ICON                = 'icon';
    public const ICON_MULTIPLE_COLOR = 'icon_multiple_color';
    public const CKEDITOR            = 'ckeditor';

    public static function getImageConversionableCollections(): array
    {
        return [
            self::IMAGES,
            self::IMAGE,
            self::LOGO,
            self::BANNER,
        ];
    }

    public static function getStreamableCollections(): array
    {
        return [
            self::VIDEO,
            self::VIDEOS
        ];
    }
}