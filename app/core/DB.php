<?php

namespace app\core;

class DB
{
    public $DB;
    private $select = '*';
    private $filter;
    private $group;
    private $order;
    private $limit;
    private $offset;
    private $count_total;

    public function __construct()
    {
        try {
            $this->DB = new \PDO('mysql:dbname=todo;host=127.0.0.1', 'root', '');
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function selectAll()
    {
        $query = $this->DB->prepare("SELECT * FROM `task` ORDER BY `ID`");
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function setSelect($fields)
    {
        $this->select = rtrim(implode(',', $fields), ',');
    }

    protected function setFilter($fields)
    {
        $filter_str = '';
        foreach ($fields as $field=>$value)
        {
            $filter_str .= strtolower($field) . '=' . '"' . $value . '"' . ', AND ';
        }
        $res = rtrim($filter_str, ', AND ');
        $this->filter = $res;
    }

    protected function exec($table_name)
    {

        $query_str = 'SELECT ' . $this->select . ' FROM ' . $table_name . ' WHERE ' . $this->filter;
        $query = $this->DB->prepare($query_str);
        $query->execute();
        return $query;
    }
}