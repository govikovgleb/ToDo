<?php
namespace app\core;
class View
{
    function printView($data = null)
    {
        $tasks = $data;
        include 'app/views/task_list.php';
    }

    function printViewAdmin($data = null, $login = null)
    {
        $user_name = $login;
        $tasks = $data;
        include 'app/views/admin_task_list.php';
    }
}