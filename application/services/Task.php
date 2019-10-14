<?php

namespace application\services;

use core\Db;
use core\Sanitizer;
use core\Auth;
use core\Log;
use application\models\Task as TaskModel;
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
        if(isset($data['title'])) {
            $this->values['title'] = $data['title'];
        }
        if(isset($data['description'])) {
            $this->values['description'] = $data['description'];
        }
    }

    protected function process($data)
    {
        $pdo = Db::getInstance()->getPdo();

        $fields = [
            'user_id',
            'title',
            'description',
            'status'
        ];
        $fields = implode(', ', $fields);

        $user = Auth::getInstance()->getIdentity();

        $values = [];
        $values['user_id']     = $user['id'];
        $values['title']       = "'" . $data['title'] . "'";
        $values['description'] = "'" . $data['description'] . "'";
        $values['status']      = TaskModel::STATUS_NEW;

        $values = '(' . implode(', ', $values) . ')';

        $sql = "INSERT INTO task ($fields) VALUES $values";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute();
        }
        catch (\PDOException $e) {
            Log::getInstance()->logError($e);
        }
    }
}
