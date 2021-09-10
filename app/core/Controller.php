<?php
namespace app\core;
class Controller
{
    public $model;
    public $view;
    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function action()
    {
        //переопределяется в наследниках
    }
}