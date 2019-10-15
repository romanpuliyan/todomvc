<?php

namespace application\models;

use core\Db;
use core\Auth;

class Task
{
    const STATUS_NEW = 1;
    const STATUS_COMPLETED = 2;

    public function getList($userId)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, user_id, title, description, status FROM task WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;
    }
}
