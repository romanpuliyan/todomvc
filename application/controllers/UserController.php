<?php

namespace application\controllers;

use core\Controller;
use application\services\Registration;

class UserController extends Controller
{
    public function actionLogin()
    {
        $this->view->render('user/login');
    }

    public function actionRegistration()
    {
        $errors = [];
        $values = [];
        if($_POST) {

            $service = new Registration();
            if($service->register($_POST)) {
                echo 'valid'; exit();
            }
            else {
                $errors = $service->getErrors();
                $values = $service->getValues();
            }
        }

        $this->view->render('user/registration', [
            'errors' => $errors,
            'values' => $values
        ]);
    }
}
