<?php

namespace core;

class Model
{
    protected $errors = [];
    protected $values = [];

    public function getErrors()
    {
        return $this->errors;
    }

    public function getValues()
    {
        return $this->values;
    }
}
