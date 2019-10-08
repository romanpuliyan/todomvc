<?php

namespace application\controllers;

use core\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $this->view->render('user/login');
    }

    public function actionRegistration()
    {
        $this->view->render('user/registration');
    }
}
