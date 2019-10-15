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
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;
    }

    public function findById($taskId)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, user_id FROM task WHERE id = :id");
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }

    public function delete($taskId)
    {
        $sql = "DELETE FROM task WHERE id = :id";

        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function changeStatus($taskId, $completed)
    {
        $status = self::STATUS_NEW;
        if($completed) {
            $status = self::STATUS_COMPLETED;
        }

        $sql = "UPDATE task SET status = :status WHERE id = :id";

        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
