<?php

namespace app\core;

class Model extends DB
{
    public $table_name;

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
                default:
                    throw new \Exception('No params getList');
            }
        }
        return parent::exec($this->table_name);
    }
}