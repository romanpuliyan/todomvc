<?php

namespace core;

class Sanitizer
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

    public function sanitize($value)
    {
        $value = $this->clean($value);
        return $value;
    }

    public function sanitizeArray($array)
    {
        if(!count($array)) {
            return;
        }

        foreach($array as $key => $value) {
            $array[$key] = $this->clean($value);
        }

        return $array;
    }

    protected function clean($value)
    {
        $value = strip_tags(trim($value));
        $value = htmlentities($value, ENT_QUOTES, 'UTF-8');
        return $value;
    }
}
