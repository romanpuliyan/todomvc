<?php

namespace core;

class Autoloader
{
    public static function load($className)
    {
        echo $className; exit();
    }
}
