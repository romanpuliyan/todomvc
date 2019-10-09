<?php

namespace core;

class Model
{
    protected $errors = [];

    public function getErrors()
    {
        return $this->errors;
    }
}
