<?php

namespace application\services\Task;

use core\{Auth, Log};
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

        // CHECK COMPLETED IS EXISTS
        if(!isset($data['completed'])) {
            Log::getInstance()->logMessage('Task delete. ID undefined');
            return false;
        }
        $completed = (boolean) $data['completed'];

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

        // PROCESS
        try {
            $model->changeStatus($taskId, $completed);
        }
        catch(\Exception $e) {
            $this->errors['common'] = 'Error while changing task status';
            Log::getInstance()->logError($e);
            return false;
        }

        return true;
    }
}
