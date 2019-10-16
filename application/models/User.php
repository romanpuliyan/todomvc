<?php

namespace application\models;

use core\{Db, Sanitizer};

class User
{

    /**
     * @param string $login
     * @return mixed
     */
    public function findByLogin(string $login)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, username, login, password FROM user WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, username, login, password FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }
}
