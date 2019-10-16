<?php

namespace core;

class FlashMessages
{
    const KEY_SUCCESS = 'success';
    const KEY_ERROR   = 'error';

    protected static $instance;

    protected function __construct() {}
    protected function __clone() {}

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get message and remove it from session
     * @param string $key
     * @return null|string
     */
    public function get(string $key)
    {
        if(isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }

        return NULL;
    }

    /**
     * Set message to session
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value)
    {
        $_SESSION['flash'][$key] = $value;
    }
}
