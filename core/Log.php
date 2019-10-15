<?php

namespace core;

class Log
{
    protected $errorFilePath;

    protected static $instance;

    protected function __construct() {
        $this->errorFilePath = APPLICATION_PATH . '/runtime/error.log';
    }

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
        $fp = fopen($this->errorFilePath, 'a+');
        fwrite($fp, PHP_EOL);
        fwrite($fp, $e->getMessage() . PHP_EOL);

        $trace = $e->getTrace();
        foreach($trace as $row) {
            fwrite($fp, $row['file'] . ' line: ' . $row['line'] . PHP_EOL);
        }

        fclose($fp);
    }

    public function logMessage($message)
    {
        $fp = fopen($this->errorFilePath, 'a+');
        fwrite($fp, PHP_EOL);
        fwrite($fp, $message . PHP_EOL);
        fclose($fp);
    }
}
