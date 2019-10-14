<?php

namespace application\controllers;

use core\Auth;
use core\Controller;
use core\FlashMessages;
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
                FlashMessages::getInstance()->set(FlashMessages::KEY_SUCCESS, "Thank's for registration");
                $this->redirect('/user/login');
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

    public function actionLogout()
    {
        if(Auth::getInstance()->hasIdentity()) {
            Auth::getInstance()->logout();
            $this->redirect('/user/login');
        }

        $this->redirect('/');
    }
}
