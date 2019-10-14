<?php

namespace application\services;

use core\Sanitizer;
use application\services\Form;

class Login extends Form
{
    public function login($data)
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

        return true;
    }

    protected function setValues($data)
    {
        if(isset($data['login'])) {
            $this->values['login'] = $data['login'];
        }        
    }
}
