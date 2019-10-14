<?php

namespace application\controllers;

use core\Controller;
use core\Auth;
use core\FlashMessages;

class MainController extends Controller
{
    function actionIndex()
    {
        if(!Auth::getInstance()->getIdentity()) {
            $this->redirect('/user/login');
        }

        $this->view->render('main/index', [
            'messageSuccess' => FlashMessages::getInstance()->get(FlashMessages::KEY_SUCCESS)
        ]);
    }
}
