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

    function render($content_view, $params = array())
    {
        $viewPath = APPLICATION_PATH . '/views/' . $content_view . '.php';
        $content = new Content();
        $content->viewPath = $viewPath;

        if(count($params)) {
            foreach($params as $key => $value) {
                $content->$key = $value;
            }
        }

        include APPLICATION_PATH . '/views/layouts/' . $this->layout . '.php';
    }
}
