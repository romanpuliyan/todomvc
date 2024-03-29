<?php

namespace application\models;

use core\{Db, Auth};

class Task
{
    const STATUS_NEW = 1;
    const STATUS_COMPLETED = 2;

    /**
     * @param int $userId
     * @return array
     */
    public function getList(int $userId): array
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, user_id, title, description, status FROM task WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $list;
    }

    /**
     * @param int $taskId
     * @return mixed
     */
    public function findById(int $taskId)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, user_id FROM task WHERE id = :id");
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }

    /**
     * @param int $taskId
     */
    public function delete(int $taskId)
    {
        $sql = "DELETE FROM task WHERE id = :id";

        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param int $taskId
     * @param int $completed
     */
    public function changeStatus(int $taskId, int $completed)
    {
        $status = self::STATUS_NEW;
        $dateCompleted = NULL;
        if($completed) {
            $status = self::STATUS_COMPLETED;
            $dateCompleted = time();
        }

        $sql = "UPDATE task SET status = :status, date_completed = :date_completed WHERE id = :id";

        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $taskId, \PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, \PDO::PARAM_INT);

        if($completed) {
            $stmt->bindParam(':date_completed', $dateCompleted, \PDO::PARAM_INT);
        }
        else {
            $stmt->bindParam(':date_completed', $dateCompleted, \PDO::PARAM_NULL);
        }

        $stmt->execute();
    }

    /**
     * @param int $userId
     * @param array $data
     * @return array
     */
    public function filter(int $userId, array $data): array
    {

        // PREPARE SQL
        $sql = "SELECT id, title, description, status FROM task WHERE user_id = :user_id ";

        if($data['title']) {
            $sql .= " AND MATCH (title) AGAINST (:title IN BOOLEAN MODE) ";
        }
        if($data['description']) {
            $sql .= " AND MATCH (description) AGAINST (:description IN BOOLEAN MODE) ";
        }
        if($data['dateFrom']) {
            $sql .= " AND date_completed >= :dateFrom ";
        }
        if($data['dateTo']) {
            $sql .= " AND date_completed <= :dateTo ";
        }

        $sql .= "ORDER BY id DESC";
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare($sql);

        // PREPARE PARAMS
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        if($data['title']) {
            $stmt->bindParam(':title', $data['title'], \PDO::PARAM_STR);
        }
        if($data['description']) {
            $stmt->bindParam(':description', $data['description'], \PDO::PARAM_STR);
        }
        if($data['dateFrom']) {
            $dateFrom = strtotime(str_replace('/', '-', $data['dateFrom']));
            $stmt->bindParam(':dateFrom', $dateFrom, \PDO::PARAM_INT);
        }
        if($data['dateTo']) {
            $dateTo = strtotime(str_replace('/', '-', $data['dateTo']));
            $stmt->bindParam(':dateTo', $dateTo, \PDO::PARAM_INT);
        }

        // GET RESULT
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
}
