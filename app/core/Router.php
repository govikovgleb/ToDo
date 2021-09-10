<?php

namespace app\core;
/**
 * маршрутизатор реализующтй Font Contcontroller
 */
class Router
{
    const path_idx = 0;
    const controller_idx = 1;
    const action_idx = 2;

    /**
     * @param $uri
     */
    public static function initRoute($uri)
    {
        $uri = preg_replace('/(\?.*)/', '', $uri);
        $routes = require 'app/routes.php';
        $controler = '';
        $action = '';
        foreach ($routes as $route)
        {
            if ($route[self::path_idx] === $uri)
            {
                $full_class_name = "app\\controllers\\" . $route[self::controller_idx];
                $controler = new $full_class_name;
                $action = $route[self::action_idx];
                $controler->$action();
            }
        }
        if (empty($controler) && empty($action))
        {
            $host = 'https://' .$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:'.$host.'404');
        }
    }
}