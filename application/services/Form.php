<?php

namespace application\services;

class Form
{
    protected $errors = [];
    protected $values = [];

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
