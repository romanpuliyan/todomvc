<?php

namespace core;

class Route
{
    public static function execute()
    {

        // DEFAULT CONTROLLER AND ACTION
        $controllerName = 'Main';
        $actionName = 'Index';

        // PARSE REQUEST
        $requestParts = explode('/', trim($_SERVER['REQUEST_URI']));

        // CONTROLLER
        if(!empty($requestParts[1])) {
            $controllerName = $requestParts[1];
        }

        // ACTION
        if(!empty($requestParts[2])) {
            $actionName = $requestParts[2];

            $params = explode('?', $actionName);
            if(!empty($params[0])) {
                $actionName = $params[0];
            }

            // IF ACTION CONSISTS FROM SEVERAL WORDS, SEPARATED BY DASH '-'
            $actionParts = explode('-', $actionName);
            if(count($actionParts) > 1) {

                $parts = [];
                foreach($actionParts as $part) {
                    $parts[] = ucfirst($part);
                }

                $actionName = implode('', $parts);
            }
        }

        if(lcfirst($controllerName) == 'error') {
            self::errorPage404();
        }
    }

    public static function send404Headers()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
    }

    public static function errorPage404()
    {
        self::send404Headers();
        $controller = new \application\controllers\ErrorController();
        $controller->actionError404();
        exit();
    }
}
