<?php

namespace app\core;

class Model extends DB
{
    public $table_name;

    /**
     * основной метод для выборки данных из БД
     * @param array $parameters
     * @return false|\PDOStatement
     * @throws \Exception
     */
    function getList($parameters = [])
    {
        foreach ($parameters as $param => $value)
        {
            switch ($param)
            {
                case 'select':
                    parent::setSelect($value);
                    break;
                case 'filter':
                    parent::setFilter($value);
                    break;
                case 'order':
                    parent::setOrder($value);
                    break;
                case 'offset':
                    parent::setOffset($value);
                    break;
                case 'limit':
                    parent::setLimit($value);
                    break;
                default:
                    throw new \Exception('Unknown param ' . $value . ' of getList');
            }
        }
        return parent::exec('select', $this->table_name);
    }

    /**
     * обновляет запись в БД
     * @param $id
     * @param array $parameters
     * @return false|\PDOStatement
     */
    function update($id, $parameters = [])
    {
        parent::setUpdate($id, $parameters);
        return parent::exec('update', $this->table_name);
    }

    /**
     * добавдяет новую запись в таблицу
     * @param array $parameters
     * @return false|\PDOStatement
     */
    function add($parameters = [])
    {
        parent::setInsert($parameters);
        return parent::exec('insert', $this->table_name);
    }

    /**
     * возвращает количество записей в таблице
     * @return mixed
     */
    function count()
    {
        return $this->DB->query('SELECT COUNT(*) FROM ' . $this->table_name)->fetchColumn();
    }
}