<?php

namespace application\controllers;

use core\Auth;
use core\Controller;
use core\FlashMessages;
use application\services\Task\TaskCreate;
use application\services\Task\TaskDelete;
use application\services\Task\TaskStatus;
use application\services\Task\TaskFilter;

class TaskController extends Controller
{
    public function actionCreate()
    {
        $this->checkIsPost();

        $service = new TaskCreate();
        if($service->create($_POST)) {
            FlashMessages::getInstance()->set(FlashMessages::KEY_SUCCESS, "Task added");
            $response = [
                'success' => true
            ];
            echo json_encode($response);
            exit();
        }
        else {
            $response = [
                'error'  => true,
                'errors' => $service->getErrors(),
                'values' => $service->getValues()
            ];
            echo json_encode($response);
            exit();
        }
    }

    public function actionDelete()
    {
        $this->checkIsPost();

        $service = new TaskDelete();
        if($service->delete($_POST)) {
            FlashMessages::getInstance()->set(FlashMessages::KEY_SUCCESS, "Task deleted");
            $response = [
                'success' => true
            ];
            echo json_encode($response);
            exit();
        }
        else {
            $response = [
                'error'   => true,
                'message' => 'Delete error'
            ];
            echo json_encode($response);
            exit();
        }
    }

    public function actionChangeStatus()
    {
        $this->checkIsPost();

        $service = new TaskStatus();
        if($service->change($_POST)) {
            $response = [
                'success' => true
            ];
            echo json_encode($response);
            exit();
        }
        else {
            $response = [
                'error'   => true,
                'message' => 'Task change status error'
            ];
            echo json_encode($response);
            exit();
        }
    }

    public function actionFilter()
    {
        if(!$_POST) {
            return;
        }

        $service = new TaskFilter();
        $list = $service->filter($_POST);
        if(!count($list)) {
            return;
        }

        $user = Auth::getInstance()->getIdentity();

        $this->view->renderPartial('partials/task-list', [
            'list' => $list,
            'user' => $user
        ]);
    }
}
