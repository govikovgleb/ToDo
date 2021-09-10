<?php

ini_set('display_errors', 1);
require_once 'vendor/autoload.php';

$auth = new \app\controllers\AuthControler();
$auth->auth_factory->newResumeService()->resume($auth->auth);
$GLOBALS['user'] = new \app\core\User($auth->auth);
\app\core\Router::initRoute($_SERVER['REQUEST_URI']);
