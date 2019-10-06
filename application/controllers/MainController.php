<?php

namespace application\controllers;

use core\Controller;

class MainController extends Controller
{
    function actionIndex()
    {
        $this->view->render('main/index');
    }
}
