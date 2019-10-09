<?php

namespace application\models;

use core\Model;
use core\Db;
use core\Sanitizer;

class User extends Model
{

    const PASSWORD_MIN_LENGTH = 6;

    public function register($data)
    {

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
}
