<?php

namespace application\controllers;

use core\Controller;
use application\services\Task;

class TaskController extends Controller
{
    public function actionCreate()
    {
        if(!$_POST) {
            return;
        }

        $service = new Task();
        if($service->create($_POST)) {
            echo 'created'; exit();
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
