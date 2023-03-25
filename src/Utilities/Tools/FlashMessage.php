<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class FlashMessage
{
    const KEY = 'flush_messages';
    const SUCCESS = 'success';
    const ERROR = 'error';
    const WARNING = 'warning';
    const INFO = 'info';

    public static function add($msg, $type = FlashMessage::SUCCESS): void
    {
        if (!isset($_SESSION[self::KEY]))
            $_SESSION[self::KEY] = [];
        $_SESSION[self::KEY][] = ['msg' => $msg, 'type' => $type];
    }

    public static function success($msg): void
    {
        self::add($msg, FlashMessage::SUCCESS);
    }

    public static function error($msg): void
    {
        self::add($msg, FlashMessage::ERROR);
    }

    public static function warning($msg): void
    {
        self::add($msg, FlashMessage::WARNING);
    }

    public static function info($msg): void
    {
        self::add($msg, FlashMessage::INFO);
    }

    public static function messageExits()
    {
        return session_exists(self::KEY);
    }

    public static function getMessages()
    {
        return self::messageExits() ? ($_SESSION[self::KEY] ?? []) : [];
    }

    public static function render()
    {
        $flash_messages = self::getMessages();
        if (empty($flash_messages)) {
            return;
        }

        $html = '<script>';
        foreach ($flash_messages as $msg)
            $html .= "Toast.fire({timer: 3000,position:'top', icon: '{$msg['type']}', title: '{$msg['msg']}' });\n";
        $html .= '</script>';
        $html .= '<style>
            .swal2-container {z-index: 999999999 !important;width:500px; }
            @media (max-width: 800px) { .swal2-container{width:96%;} }
            .swal2-info .swal2-icon-content,.swal2-error .swal2-icon-content,.swal2-warning .swal2-icon-content{margin-top:8px}
        </style>';
        return $html;
    }

    public static function print(): void
    {
        echo self::render();
        self::clean();
    }

    public static function clean(): void
    {
        if (!self::messageExits())
            return;

        unset($_SESSION[self::KEY]);
    }
}