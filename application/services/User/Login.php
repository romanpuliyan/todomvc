<?php

namespace application\services\User;

use core\{Sanitizer, Auth};
use application\models\User;
use application\services\Form;

class Login extends Form
{

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data): bool
    {
        $sanitizer = Sanitizer::getInstance();
        $data = $sanitizer->sanitizeArray($data);
        $this->setValues($data);

        // CHECK LOGIN
        if(!isset($data['login']) || empty($data['login'])) {
            $this->errors['login'] = 'Login is required';
        }

        // CHECK PASSWORD
        if(!isset($data['password']) || empty($data['password'])) {
            $this->errors['password'] = 'Enter password';
        }

        if(count($this->errors)) {
            return false;
        }

        // FIND USER
        $model = new User();
        $user = $model->findByLogin($data['login']);
        if(!$user) {
            $this->errors['common'] = 'User not found';
            return false;
        }

        // CHECK PASSWORD IS CORRECT
        if($user['password'] != Auth::getInstance()->encryptPassword($data['password'])) {
            $this->errors['common'] = 'Incorrect password';
            return false;
        }

        // AUTHENTICATE
        Auth::getInstance()->authenticate($user);

        return true;
    }

    /**
     * @param array $data
     */
    protected function setValues(array $data)
    {
        if(isset($data['login'])) {
            $this->values['login'] = $data['login'];
        }
    }
}
