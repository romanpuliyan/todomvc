<?php

namespace application\services;

use core\Db;
use core\Auth;
use core\Log;

class TaskDelete
{
    public function delete($data)
    {
        if(!$data['taskId']) {
            Log::getInstance()->logMessage('Task delete. ID undefined');
            return false;
        }

        return true;
    }
}
