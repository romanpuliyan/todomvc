<?php

namespace application\controllers;

use core\Controller;
use application\models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        $this->view->render('user/login');
    }

    public function actionRegistration()
    {
        $errors = [];
        if($_POST) {
            $model = new User();
            if($model->register($_POST)) {

            }
            else {
                $errors = $model->getErrors();
            }
        }

        $this->view->render('user/registration', [
            'errors' => $errors
        ]);
    }
}
