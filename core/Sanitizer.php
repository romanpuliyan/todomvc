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

    /**
     * Escape parameter
     * @param mixed $value
     * @return string
     */
    public function sanitize($value): string
    {
        $value = $this->clean($value);
        return $value;
    }

    /**
     * Escape array values
     * @param array $array
     * @return array|void
     */
    public function sanitizeArray(array $array)
    {
        if(!count($array)) {
            return;
        }

        foreach($array as $key => $value) {
            $array[$key] = $this->clean($value);
        }

        return $array;
    }

    /**
     * Process escaping
     * @param mixed $value
     * @return string
     */
    protected function clean($value): string
    {
        $value = strip_tags(trim($value));
        $value = htmlentities($value, ENT_QUOTES, 'UTF-8');
        return $value;
    }
}
