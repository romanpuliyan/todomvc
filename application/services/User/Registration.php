<?php

namespace application\services\User;

use core\{Db, Sanitizer, Auth, Log};
use application\models\User;
use application\services\Form;

class Registration extends Form
{

    const PASSWORD_MIN_LENGTH = 6;

    public function register($data)
    {

        $pdo = Db::getInstance()->getPdo();

        $sanitizer = Sanitizer::getInstance();
        $data = $sanitizer->sanitizeArray($data);
        $this->setValues($data);

        // CHECK USERNAME
        if(!isset($data['username']) || empty($data['username'])) {
            $this->errors['username'] = 'Username is required';
        }

        // CHECK LOGIN
        if(!isset($data['login']) || empty($data['login'])) {
            $this->errors['login'] = 'Login is required';
        }
        else {
            $model = new User();
            $user = $model->findByLogin($data['login']);
            if($user) {
                $this->errors['login'] = 'There is other user with login "' . $data['login'] . '""';
            }
        }

        // CHECK PASSWORD
        $passwordError = false;
        if(!isset($data['password']) || empty($data['password'])) {
            $passwordError = true;
            $this->errors['password'] = 'Enter password';
        }
        else {
            if(mb_strlen($data['password']) < self::PASSWORD_MIN_LENGTH) {
                $passwordError = true;
                $this->errors['password'] = 'Password have to be at least ' . self::PASSWORD_MIN_LENGTH . ' characters';
            }
        }
        if(!isset($data['repeat-password']) || empty($data['repeat-password'])) {
            $passwordError = true;
            $this->errors['repeat-password'] = 'Repeat password';
        }
        if(!$passwordError) {
            if($data['password'] != $data['repeat-password']) {
                $this->errors['repeat-password'] = 'Password mismatch';
            }
        }

        if(count($this->errors)) {
            return false;
        }

        // PROCESS
        try {
            $this->process($data);
        }
        catch(\Exception $e) {
            $this->errors['common'] = 'Error while processing form';
            Log::getInstance()->logError($e);
            return false;
        }

        return true;
    }

    protected function setValues($data)
    {
        if(isset($data['username'])) {
            $this->values['username'] = $data['username'];
        }
        if(isset($data['login'])) {
            $this->values['login'] = $data['login'];
        }
        if(isset($data['password'])) {
            $this->values['password'] = $data['password'];
        }
        if(isset($data['repeat-password'])) {
            $this->values['repeat-password'] = $data['repeat-password'];
        }
    }

    protected function process($data)
    {
        $pdo = Db::getInstance()->getPdo();

        $fields = [
            'username',
            'login',
            'password'
        ];
        $fields = implode(', ', $fields);

        $password = Auth::getInstance()->encryptPassword($data['password']);

        $values = [];
        $values['username'] = "'" . $data['username'] . "'";
        $values['login']    = "'" . $data['login'] . "'";
        $values['password'] = "'" . $password . "'";

        $values = '(' . implode(', ', $values) . ')';

        $sql = "INSERT INTO user ($fields) VALUES $values";
        $stmt = $pdo->prepare($sql);

        try {

            // ADD USER
            $stmt->execute();
            $id = $pdo->lastInsertId();

            // GET ROW
            $model = new User();
            $user = $model->findById($id);

            // AUTHENTICATE
            Auth::getInstance()->authenticate($user);
        }
        catch (\PDOException $e) {
            Log::getInstance()->logError($e);
        }
    }
}
