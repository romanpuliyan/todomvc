<?php

namespace application\controllers;

use core\{Controller, Auth, FlashMessages};
use application\models\Task as TaskModel;

class MainController extends Controller
{
    function actionIndex()
    {
        $user = Auth::getInstance()->getIdentity();
        if(!$user) {
            $this->redirect('/user/login');
        }

        $model = new TaskModel();
        $list = $model->getList($user['id']);

        $this->view->render('main/index', [
            'list' => $list,
            'user' => $user,
            'messageSuccess' => FlashMessages::getInstance()->get(FlashMessages::KEY_SUCCESS)
        ]);
    }
}
