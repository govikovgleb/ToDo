<?php

namespace app\core;

class DB
{
    public $DB;
    private $select = '*';
    private $filter;
    private $order;
    private $limit;
    private $offset;

    private $update;
    private $insert;


    public function __construct()
    {
        $config = require 'app/.config.php';
        $config_DB = $config['DB'];
        $dsn = $config_DB['module'] . ':' . 'dbname=' . $config_DB['dbname'] . ';host=' . $config_DB['host'];
        try {
            $this->DB = new \PDO($dsn, $config_DB['user'], $config_DB['password']);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
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
     * @param $fields
     */
    protected function setInsert($fields)
    {
        foreach ($fields as $field=>$value)
        {
            $ar_fields[] = strtolower($field);
            $ar_values[] = '"' . $value . '"';
        }
        $str_fields = implode(',', $ar_fields);
        $str_values = implode(',', $ar_values);
        $this->insert = '(' . $str_fields . ')' . ' VALUES ' . '(' . $str_values . ')';
    }

    /**
     * @param $id
     * @param $fields
     */
    protected function setUpdate($id, $fields)
    {
        $update_str = '';
        foreach ($fields as $field=>$value)
        {
            $update_str .= strtolower($field) . '=' . '"' . $value . '"' . ',';
        }

        $this->update = rtrim($update_str, ',') . ' WHERE ID=' . $id;
    }

    /**
     * @param $value
     */
     protected function setOffset($value)
     {
         $this->offset = intval($value);
     }

    /**
     * @param $value
     */
     protected function setLimit($value)
     {
         $this->limit = intval($value);
     }

    /**
     * @param $type
     * @param $table_name
     * @return string
     */
    private function prepareQuery($type, $table_name)
    {
        switch ($type)
        {
            case 'select':
                $query_str = 'SELECT ' . $this->select . ' FROM ' . $table_name;
                if($this->filter) $query_str .= ' WHERE ' . $this->filter;
                if($this->order) $query_str .= ' ORDER BY ' . $this->order;
                if(isset($this->offset) && $this->limit) $query_str .= ' LIMIT ' . $this->offset . ',' . $this->limit;
                break;
            case 'update':
                $query_str = 'UPDATE ' . $table_name . ' SET ' . $this->update;
                break;
            case 'insert':
                $query_str = 'INSERT INTO ' . $table_name . $this->insert;
        }

        return $query_str;
    }

    protected function exec($type, $table_name)
    {
        $query_str = $this->prepareQuery($type, $table_name);
        $query = $this->DB->prepare($query_str);
        $query->execute();
        return $query;
    }
}