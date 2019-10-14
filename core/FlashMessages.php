<?php

namespace core;

class FlashMessages
{
    const KEY_SUCCESS = 'success';
    const KEY_ERROR   = 'error';

    protected static $instance;

    protected function __construct()
    {
        session_start();
    }

    protected function __clone() {}

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($key)
    {
        if(isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }

        return NULL;
    }

    public function set($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }
}
