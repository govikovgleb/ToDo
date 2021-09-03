<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';

$auth = new app\controllers\AuthControler();
$auth->auth_factory->newResumeService()->resume($auth->auth);

if($_POST['login'] && $_POST['password'] && $auth->auth->isAnon())
{
    $user_data = $auth->login($_POST['login'], $_POST['password']);

    if ($user_data)
    {
        $cont = new app\controllers\TaskControler();
        if ($auth->isAdmin()) {
            $cont->actionAdmin($user_data['login']);
        }else{
            $cont->action();
        }
    } else {
        echo json_encode($user_data);
    }

    /*echo json_encode($user_data);
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";*/
} elseif($auth->auth->isValid() && $_POST['logout']) {
    $auth->logout();
    $cont = new app\controllers\TaskControler();
    $cont->action();
} elseif($auth->auth->isValid() && $auth->isAdmin()) {
    $user_data = $auth->auth->getUserData();
    $cont = new app\controllers\TaskControler();
    $cont->actionAdmin($user_data['login']);

} elseif($auth->auth->isAnon()) {
    $cont = new app\controllers\TaskControler();
    $cont->action();
}


