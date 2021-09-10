<?php
namespace app\controllers;

/**
 * Контроллер отвечающий за сущность "задача".
 * Так как в приложении взаимодействие осуществляется за одним исключением только с этой сущностью, то основная логика находмтся здесь
 */
use app\core\Controller,
    app\models\TaskModel;

class TaskControler extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->model = new TaskModel();
    }

    /**
     *
     * @throws \Exception
     */
    function action()
    {
        $pagin = $this->getPage();
        $data = $this->model->getList([
            'select' => ['*'],
            'order' => ['user_name' => 'DESC'],
            'offset' => $pagin['offset'],
            'limit' => $pagin['limit']
        ])->fetchAll(\PDO::FETCH_ASSOC);

        $this->view->render('task_list.php', ['count_pages' => $pagin['count_pages'],'page' => $pagin['page'], 'tasks' => $data]);
    }


    /**
     * @return array
     */
    private function getPage()
    {
        $limit = 3;
        $page = $_GET['page'] ?? 1;
        $offset = (intval($page) - 1) * $limit;
        $count_rows = intval($this->model->count());
        $count_pages = ceil($count_rows / $limit);
        return ['offset' => $offset, 'limit' => $limit, 'page' => intval($page), 'count_pages' => $count_pages];
    }

    /**
     * обновление статуса и описания в задаче
     * @throws \Exception
     */
    function taskUpdate()
    {
        $parameters = [
            'status' => $_REQUEST['status'],
            'description' => $_REQUEST['description'],
            'label' => 'modified by admin'
        ];
        $this->model->update($_REQUEST['task_id'], $parameters);
        $this->action();
    }

    /**
     * добавление новой задачи
     * @throws \Exception
     */
    function taskAdd()
    {
        $parameters = $_POST;
        $parameters['status'] = 'not in work';
        $this->model->add($parameters);
        $this->action();
    }
}