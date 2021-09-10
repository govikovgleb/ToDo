<?php

namespace app\models;
/**
 * модель отвечающая за пользователей
 */

use app\core\Model;

class UserModel extends Model
{
    public $table_name = 'users';
    public $fields = [
      'login',
      'password',
      'access'
    ];

    /**
     * проверяет есть ли такой пользователь и если есть возвращает соответствующую запись из БД
     * @param $login
     * @param $password
     * @return mixed
     * @throws \Exception
     */
    public function checkUser($login, $password)
    {
        return parent::getList(['filter' => ['login' => $login, 'password' => $password]])->fetch(\PDO::FETCH_ASSOC);
    }
}