<?php

namespace core\view;

class Content
{
    public $viewPath;
    public $view;

    protected $params = [];

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function __toString()
    {
        if(count($this->params)) {
            extract($this->params);
        }

        require_once $this->viewPath;
        return '';
    }

    public function __set($name, $value)
    {
        if(isset($this->params[$name])) {
            return;
        }

        $this->params[$name] = $value;
    }

    public function __get($name)
    {
        if(isset($this->params[$name])) {
            return $this->params[$name];
        }

        return NULL;
    }

    /**
     * @param string $viewPath path to view file
     * @param array $params params for view
     */
    public function partial(string $viewPath, array $params = array())
    {
        $this->view->renderPartial($viewPath, $params);
    }
}
