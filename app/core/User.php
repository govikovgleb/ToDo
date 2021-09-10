<?php

namespace app\core;
/**
 * сущность пользователся необходимая для использования в представлении
 */
use \Aura\Auth\Auth;
class User
{
    public $name;
    public $access;
    public $authorize = false;

    function __construct(Auth $auth)
    {
        if ($auth->isValid())
        {
            $data = $auth->getUserData();
            $this->name = $data['login'];
            $this->access = $data['access'];
            $this->authorize = true;
        }
    }

    /**
     * @return bool
     */
    function isAdmin()
    {
        return ($this->access === 'admin');
    }

    /**
     * @return bool
     */
    function isAuthorize()
    {
        return $this->authorize;
    }
}