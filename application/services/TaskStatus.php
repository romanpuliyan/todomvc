<?php

namespace application\services;

use core\Auth;
use core\Log;
use application\models\Task;

class TaskStatus
{
    public function change($data)
    {
        // CHECK TASK ID EXISTS
        if(!$data['taskId']) {
            Log::getInstance()->logMessage('Task delete. ID undefined');
            return false;
        }
        $taskId = (int) $data['taskId'];

        if(!$taskId) {
            Log::getInstance()->logMessage("Task delete. ID is not integer. Value: '$taskId'");
            return false;
        }

        // CURRENT USER
        $user   = Auth::getInstance()->getIdentity();
        $userId = $user['id'];

        // CHECK USER IS OWNER
        $model = new Task();
        $task = $model->findById($taskId);
        if($task['user_id'] != $userId) {
            $message = "Task change status. User with ID $userId is not owner of task $taskId";
            Log::getInstance()->logMessage($message);
            return false;
        }

        return true;
    }
}
