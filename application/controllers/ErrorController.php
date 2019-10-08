<?php

namespace application\controllers;

use core\Controller;

class ErrorController extends Controller
{
    public function actionError($exception)
    {
        $this->view->render('error/error', [
            'exception' => $exception
        ]);
    }

    public function actionError404()
    {
        $this->view->render('error/error-404');
    }
}
