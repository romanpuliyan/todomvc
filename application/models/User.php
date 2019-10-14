<?php

namespace application\models;

use core\Db;
use core\Sanitizer;

class User
{
    public function findByLogin($login)
    {
        $pdo = Db::getInstance()->getPdo();
        $stmt = $pdo->prepare("SELECT id, username, login, password FROM user WHERE login = ?");
        $stmt->bind('login', $login);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}