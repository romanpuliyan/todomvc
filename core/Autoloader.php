<?php

namespace core;

class Autoloader
{

    /**
     * @param $className
     * @return bool
     * @throws \Exception
     */
    public static function load($className): bool
    {
        // REPLACE '\' TO '/'. 2 SLASHES, BECAUSE ESCAPING
        $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $absolutePath = realpath(APPLICATION_PATH . "/../" . $relativePath . '.php');

        if(file_exists($absolutePath)) {

            // INCLUDE FILE
            require_once $absolutePath;

            if(class_exists($className)) {
                return true;
            }

            throw new \Exception('Not Found');
        }

        throw new \Exception('Not Found');
    }
}
