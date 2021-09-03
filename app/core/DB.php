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

    /**
     * @param $fields
     */
    protected function setSelect($fields)
    {
        $this->select = rtrim(implode(',', $fields), ',');
    }

    /**
     * @param $fields
     */
    protected function setFilter($fields)
    {
        $filter_str = '';
        foreach ($fields as $field=>$value)
        {
            $filter_str .= strtolower($field) . '=' . '"' . $value . '"' . ' AND ';
        }

        $this->filter = rtrim($filter_str, ' AND ');
    }

    /**
     * @param $fields
     */
    protected function setOrder($fields)
    {
        $order_str = '';
        foreach ($fields as $field=>$sort)
        {
            $order_str .= strtolower($field) . ' ' . $sort . ',';
        }
        $this->order = rtrim($order_str, ',');
    }

    /**
     * @param $table_name
     * @return string
     */
    private function prepareQuery($table_name)
    {
        $query_str = 'SELECT ' . $this->select . ' FROM ' . $table_name;
        if($this->filter) $query_str .= ' WHERE ' . $this->filter;
        if($this->order) $query_str .= ' ORDER BY ' . $this->order;

        return $query_str;
    }

    protected function exec($table_name)
    {
        $query_str = $this->prepareQuery($table_name);
        $query = $this->DB->prepare($query_str);
        $query->execute();
        return $query;
    }
}