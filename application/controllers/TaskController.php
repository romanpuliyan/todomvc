<?php

namespace application\controllers;

use core\Controller;
use core\FlashMessages;
use application\services\Task;
use application\services\TaskDelete;
use application\services\TaskStatus;

class TaskController extends Controller
{
    public function actionCreate()
    {
        $this->checkIsPost();

        $service = new Task();
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
}
