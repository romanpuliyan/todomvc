<?php

namespace core;

class Log
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

    public function logError($e)
    {
        $errorFilePath = APPLICATION_PATH . '/runtime/error.log';
        $fp = fopen($errorFilePath, 'a+');
        fwrite($fp, PHP_EOL);
        fwrite($fp, $e->getMessage() . PHP_EOL);

        $trace = $e->getTrace();
        foreach($trace as $row) {
            fwrite($fp, $row['file'] . ' line: ' . $row['line'] . PHP_EOL);
        }

        fclose($fp);
    }
}
