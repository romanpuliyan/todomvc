<?php

namespace application\services;

use core\Sanitizer;
use application\services\Form;

class Task extends Form
{
    public function create($data)
    {
        $sanitizer = Sanitizer::getInstance();
        $data = $sanitizer->sanitizeArray($data);
        $this->setValues($data);

        // CHECK TITLE
        if(!isset($data['title']) || empty($data['title'])) {
            $this->errors['title'] = 'Title is required';
        }

        // CHECK DESCRIPTION
        if(!isset($data['description']) || empty($data['description'])) {
            $this->errors['description'] = 'Description is required';
        }

        if(count($this->errors)) {
            return false;
        }

        // PROCESS
    }

    protected function setValues($data)
    {
        if(isset($data['title'])) {
            $this->values['title'] = $data['title'];
        }
        if(isset($data['description'])) {
            $this->values['description'] = $data['description'];
        }
    }
}
