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

        // CAN NOT MANUALY LOAD ERROR PAGES
        if(lcfirst($controllerName) == 'error') {
            self::errorPage404();
        }

        // PREFIXES
        $controllerName = ucfirst($controllerName);
        $actionName     = ucfirst($actionName);
        $controllerName = $controllerName . 'Controller';
        $actionName     = 'action' . $actionName;

        // CREATE CONTROLLER
        try {
            $qualifiedControllerName = '\\application\\controllers\\' . $controllerName;
            $controller = new $qualifiedControllerName;
        }
        catch(\Exception $e) {
            self::errorPage404();
        }

        // EXECUTE ACTION
        $action = $actionName;
        if(method_exists($controller, $action)) {
            try {
                $controller->$action();
            }
            catch(\Exception $e) {
                self::errorPage($e);
            }
        }
        else {
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

    public static function errorPage()
    {
        http_response_code(500);

        $controller = new \application\controllers\ErrorController();
        $controller->actionError();
        exit();
    }
}
