<?php

namespace core;

class Db
{

    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $config = Registry::getInstance()->get('config');
        $config = $config['db'];

        $host     = $config['host'];
        $dbname   = $config['dbname'];
        $user     = $config['user'];
        $password = $config['password'];

        $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
