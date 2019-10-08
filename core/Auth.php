<?php

namespace core;

class Auth
{
    protected static $instance;

    protected function __construct()
    {
        session_start();
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getIdentity()
    {
        if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            return NULL;
        }

        return $_SESSION['user'];
    }
}
