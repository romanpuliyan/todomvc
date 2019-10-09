<?php

namespace application\models;

use core\Model;
use core\Db;

class User extends Model
{
    public function register($data)
    {        
        //var_dump($data); exit();

        if(!isset($data['username']) || empty($data['username'])) {
            $this->errors['username'] = 'Username is required';
        }

        if(!isset($data['login']) || empty($data['login'])) {
            $this->errors['login'] = 'Login is required';
        }

        $passwordError = false;
        if(!isset($data['password']) || empty($data['password'])) {
            $passwordError = true;
            $this->errors['password'] = 'Enter password';
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


    }
}
