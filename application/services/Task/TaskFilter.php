<?php

namespace application\services\Task;

use core\{Auth, Sanitizer};
use application\models\Task;

class TaskFilter
{
    public function filter($data)
    {
        $sanitizer = Sanitizer::getInstance();
        $data = $sanitizer->sanitizeArray($data);

        // CURRENT USER
        $user   = Auth::getInstance()->getIdentity();
        $userId = $user['id'];

        $model = new Task();
        $rows = $model->filter($userId, $data);
        return $rows;
    }
}
