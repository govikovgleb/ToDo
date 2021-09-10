<?php

namespace app\models;
/**
 * модель отвечающая за задачи.
 * Содержит в себе только свойства, так как все необходимые методы есть у общей модели
 */
use app\core\Model;

class TaskModel extends Model
{
    public $table_name = 'tasks';
    public $fields =[
      'user_name',
      'user_email',
      'name',
      'description',
      'status',
      'label',
      'data_update',
      'data_create',
    ];
}

