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
        $viewPath = $this->getViewPath($contentView);
        $content = new Content();
        $content->viewPath = $viewPath;        
        $this->setContentParams($content, $params);

        include APPLICATION_PATH . '/views/layouts/' . $this->layout . '.php';
    }

    public function renderAjax($contentView, $params = array())
    {
        $viewPath = $this->getViewPath($contentView);
        $content = new Content();
        $content->viewPath = $viewPath;
        $this->setContentParams($content, $params);
        echo $content;
    }

    protected function getViewPath($contentView)
    {
        return APPLICATION_PATH . '/views/' . $contentView . '.php';
    }

    protected function setContentParams($content, $params)
    {
        if(count($params)) {
            foreach($params as $key => $value) {
                $content->$key = $value;
            }
        }
    }
}
