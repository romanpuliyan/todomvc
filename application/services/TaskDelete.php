<?php

namespace application\services;

use core\Db;
use core\Auth;
use core\Log;
use application\models\Task;

class TaskDelete
{
    public function delete($data)
    {

        // CHECK TASK ID EXISTS
        if(!$data['taskId']) {
            Log::getInstance()->logMessage('Task delete. ID undefined');
            return false;
        }
        $taskId = $data['taskId'];

        // CURRENT USER
        $user   = Auth::getInstance()->getIdentity();
        $userId = $user['id'];
        $userId = 2;

        // CHECK USER IS OWNER
        $model = new Task();
        $task = $model->findById($taskId);
        if($task['user_id'] != $userId) {
            $message = "Task delete. User with ID $userId is not owner of task $taskId";
            Log::getInstance()->logMessage($message);
            return false;
        }

        return true;
    }
}
