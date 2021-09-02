<?php
namespace app\controllers;
use app\core\Controller,
    app\models\taskModel;

class TaskControler extends Controller
{
    function __construct()
    {
        $this->model = new taskModel();
        parent::__construct();
    }

    function action()
    {
        $data = $this->model->getList([
            'filter' => ['name' => 'read book']
        ])->fetchAll(\PDO::FETCH_ASSOC);
        //$data = $this->model->selectAll();
        $this->view->printView($data);
    }
}