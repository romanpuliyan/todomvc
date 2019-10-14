<?php

namespace application\controllers;

use core\Controller;
use core\Auth;

class MainController extends Controller
{
    function actionIndex()
    {
        if(!Auth::getInstance()->getIdentity()) {
            $this->redirect('/user/login');
        }

        $this->view->render('main/index');
    }
}
