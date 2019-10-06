<?php

namespace core;

class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
        $this->init();
    }

    public function init()
    {

    }
}
