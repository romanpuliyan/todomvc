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
}
