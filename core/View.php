<?php

namespace core;

use core\view\Content;

class View
{

    public $layout;

    public function __construct()
    {
        $this->layout = 'main';
        require_once APPLICATION_PATH . '/../core/view/Content.php';
    }

    public function render($contentView, $params = array())
    {
        $content = $this->prepareContent($contentView, $params);
        include APPLICATION_PATH . '/views/layouts/' . $this->layout . '.php';
    }

    public function renderPartial($contentView, $params = array())
    {
        $content = $this->prepareContent($contentView, $params);
        echo $content;
    }

    protected function prepareContent($contentView, $params = array())
    {
        $viewPath = $this->getViewPath($contentView);
        $content = new Content($this);
        $content->viewPath = $viewPath;

        if(count($params)) {
            foreach($params as $key => $value) {
                $content->$key = $value;
            }
        }

        return $content;
    }

    protected function getViewPath($contentView)
    {
        return APPLICATION_PATH . '/views/' . $contentView . '.php';
    }
}
