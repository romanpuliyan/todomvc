<?php

namespace application\services\Task;

use core\{Auth, Log};
use application\models\Task;

class TaskDelete
{

    /**
     * @param array $data
     * @return bool
     */
    public function delete(array $data): bool
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
            $message = "Task delete. User with ID $userId is not owner of task $taskId";
            Log::getInstance()->logMessage($message);
            return false;
        }

        // PROCESS
        try {
            $model->delete($taskId);
        }
        catch(\Exception $e) {
            $this->errors['common'] = 'Error while deleting task';
            Log::getInstance()->logError($e);
            return false;
        }

        return true;
    }
}
