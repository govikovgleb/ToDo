<?php
namespace app\controllers;
use app\core\Controller,
    app\models\UserModel,
    \Aura\Auth\AuthFactory as AuthFactory;

class AuthControler extends Controller
{
    public $auth;
    public $auth_factory;

    function __construct()
    {
        $this->auth_factory = new AuthFactory($_COOKIE);
        $this->auth = $this->auth_factory->newInstance();
        $this->model = new UserModel();
        parent::__construct();
    }

    public function login($login, $password)
    {
        $user = $this->model->checkUser($login, $password);
        if ($user)
        {
            $login_service = $this->auth_factory->newLoginService();
            $username = $user['login'];
            $userdata = $user;
            $login_service->forceLogin($this->auth, $username, $userdata);
        }

        return $user;
    }

    public function logout()
    {
        $logout_service = $this->auth_factory->newLogoutService();

        $logout_service->forceLogout($this->auth);
    }

    public function isAdmin()
    {
        $user_data = $this->auth->getUserData();
        return ($user_data['access'] === 'admin');
    }
}