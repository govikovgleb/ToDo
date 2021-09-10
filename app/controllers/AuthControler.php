<?php
namespace app\controllers;

/**
 * этот объект отвечает за авторизацию и сохрание пользователя в сессии.
 * по структуре не является контролером, но так как вызывается пользователем, часть опций котнролера выполнякт
 *
 */
use app\core\Controller,
    app\models\UserModel,
    \Aura\Auth\AuthFactory as AuthFactory,
     app\core\User;

class AuthControler extends Controller
{
    public $auth;
    public $auth_factory;

    function __construct()
    {
        $this->auth_factory = new AuthFactory($_COOKIE);
        $this->auth = $this->auth_factory->newInstance();
        parent::__construct();
        $this->model = new UserModel();
    }

    /**
     * @throws \Exception
     */
    public function login()
    {
        $user = $this->model->checkUser($_REQUEST['login'], $_REQUEST['password']);
        if ($user)
        {
            $login_service = $this->auth_factory->newLoginService();
            $username = $user['login'];
            $userdata = $user;
            $login_service->forceLogin($this->auth, $username, $userdata);

            $GLOBALS['user'] = new User($this->auth);
        }
    }

    public function logout()
    {
        $logout_service = $this->auth_factory->newLogoutService();

        $logout_service->forceLogout($this->auth);
        $GLOBALS['user'] = new User($this->auth);
    }
}