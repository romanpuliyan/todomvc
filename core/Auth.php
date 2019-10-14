<?php

namespace core;

class Auth
{
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

    public function getIdentity()
    {
        if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            return NULL;
        }

        return $_SESSION['user'];
    }

    public function hasIdentity()
    {
        if(isset($_SESSION['user'])) {
            return true;
        }

        return false;
    }

    public function encryptPassword($password)
    {
        if(!$password) {
            return NULL;
        }

        return md5($password);
    }

    public function authenticate($data)
    {
        if(!$data) {
            return;
        }

        if(isset($data['password'])) {
            unset($data['password']);
        }

        $_SESSION['user'] = $data;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}
