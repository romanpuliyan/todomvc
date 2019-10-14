<?php

namespace application\controllers;

use core\Controller;
use core\FlashMessages;
use application\services\Task;

class TaskController extends Controller
{
    public function actionCreate()
    {
        if(!$_POST) {
            $response = [
                'error'  => true,
                'errors' => [
                    'common' => 'Fill the form please'
                ]
            ];
            echo json_encode($response);
            exit();
        }

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
}
