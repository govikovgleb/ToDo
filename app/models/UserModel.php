<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public $table_name = 'users';

    public function checkUser($login, $password)
    {
        return parent::getList(['filter' => ['login' => $login, 'password' => $password]])->fetch(\PDO::FETCH_ASSOC);
    }
}