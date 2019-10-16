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

    /**
     * Render view with layout
     * @param string $contentView path to a view file
     * @param array $params data which a view file needs
     */
    public function render(string $contentView, array $params = array())
    {
        $content = $this->prepareContent($contentView, $params);
        include APPLICATION_PATH . '/views/layouts/' . $this->layout . '.php';
    }

    /**
     * Render view without layout
     * @param string $contentView path to a view file
     * @param array $params data which a view file needs
     */
    public function renderPartial(string $contentView, array $params = array())
    {
        $content = $this->prepareContent($contentView, $params);
        echo $content;
    }

    /**
     * Create view content and set params
     * @param string $contentView path to a view file
     * @param array $params data which a view file needs
     * @return Content
     */
    protected function prepareContent(string $contentView, array $params = array()): Content
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

    /**
     * Full path to a view file
     * @param string $contentView path to a view file
     * @return string
     */
    protected function getViewPath(string$contentView): string
    {
        return APPLICATION_PATH . '/views/' . $contentView . '.php';
    }
}
