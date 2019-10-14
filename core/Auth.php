<?php

namespace core;

class Auth
{
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

    public function getIdentity()
    {
        if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            return NULL;
        }

        return $_SESSION['user'];
    }

    public function encryptPassword($password)
    {
        return md5($password);
    }

    public function authenticate($data)
    {
        if(isset($data['password'])) {
            unset($data['password']);
        }

        $_SESSION['user'] = $data;
    }
}
