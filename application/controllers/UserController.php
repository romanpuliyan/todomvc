<?php

namespace application\controllers;

use core\{Auth, Controller, FlashMessages};
use application\services\User\{Registration, Login};

class UserController extends Controller
{
    public function actionLogin()
    {
        $errors = [];
        $values = [];
        if($_POST) {
            $service = new Login();
            if($service->login($_POST)) {
                $this->redirect('/');
            }
            else {
                $errors = $service->getErrors();
                $values = $service->getValues();
            }
        }

        $this->view->render('user/login', [
            'errors' => $errors,
            'values' => $values
        ]);
    }

    public function actionRegistration()
    {
        $errors = [];
        $values = [];
        if($_POST) {
            $service = new Registration();
            if($service->register($_POST)) {
                FlashMessages::getInstance()->set(FlashMessages::KEY_SUCCESS, "Thank's for registration");
                $this->redirect('/');
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
