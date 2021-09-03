<?php
namespace app\controllers;
use app\core\Controller,
    app\models\TaskModel;

class TaskControler extends Controller
{
    function __construct()
    {
        $this->model = new TaskModel();
        parent::__construct();
    }

    function action()
    {
        $data = $this->model->getList([
            'select' => ['*'],
            'order' => ['user_name' => 'DESC']
        ])->fetchAll(\PDO::FETCH_ASSOC);
        //$data = $this->model->selectAll();
        $this->view->printView($data);
    }

    function actionAdmin($login)
    {
        $data = $this->model->getList([
            'select' => ['*'],
            'order' => ['user_name' => 'DESC']
        ])->fetchAll(\PDO::FETCH_ASSOC);
        //$data = $this->model->selectAll();
        $this->view->printViewAdmin($data, $login);
    }
}