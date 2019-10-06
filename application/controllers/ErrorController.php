<?php

namespace application\controllers;

use core\Controller;

class ErrorController extends Controller
{
    public function actionError()
    {
        $this->view->render('error/error');
    }

    public function actionError404()
    {
        $this->view->render('error/error-404');
    }
}
