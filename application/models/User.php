<?php

namespace application\models;

use core\Db;
use core\Sanitizer;

class User
{
    public function findByLogin($login)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, username, login, password FROM user WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }
}
