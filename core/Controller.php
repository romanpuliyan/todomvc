<?php

namespace core;

class Controller
{
    public $view;

    public function __construct($view)
    {
        $this->view = $view;
        $this->init();
    }

    public function init()
    {

    }

    public function redirect($route)
    {
        if(!$route) {
            throw new \Exception('Undefined value for redirect');
        }

        header("Location: $route");
    }

    protected function checkIsPost()
    {
        if($_POST) {
            return;
        }

        $response = [
            'error'  => true,
            'errors' => [
                'common' => 'Wrong request'
            ]
        ];
        echo json_encode($response);
        exit();
    }
}
