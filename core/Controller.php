<?php

namespace core;

class Controller
{
    public $view;

    /**
     * Controller constructor.
     * @param View $view
     */
    public function __construct($view)
    {
        $this->view = $view;
        $this->init();
    }

    public function init()
    {

    }

    /**
     * @param string $route
     * @throws \Exception
     */
    public function redirect(string $route)
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
