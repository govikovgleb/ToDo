<?php
namespace app\core;
class View
{
    function printView($data = null)
    {
        if (is_array($data))
        {
            extract($data[0]);
        }

        include 'app/views/task_list.php';
    }
}