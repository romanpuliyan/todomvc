<?php

namespace core;

class Registry
{

    protected $params = [];
    protected static $instance;

    protected function __construct()
    {
        $configPath = APPLICATION_PATH . '/config/main.php';
        $config = array_merge(require_once $configPath);
        $this->params['config'] = $config;
    }

    protected function __clone() {}

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __set($name, $value)
    {
        if(isset($this->params[$name])) {
            return;
        }

        $this->params[$name] = $value;
    }

    public function __get($name)
    {
        if(isset($this->params[$name])) {
            return $this->params[$name];
        }

        return NULL;
    }

    public function set($name, $value)
    {
        $this->$name = $value;
    }

    public function get($name)
    {
        return $this->$name;
    }
}
