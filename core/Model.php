<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 22/02/17
 * Time: 10:26 ص
 */

namespace App\Core;


class Model
{
    protected $table;
    protected $builder;
    function __construct()
    {
        $this->builder=App::get('database');
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @param mixed $builder
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }

    public function all()
    {
        return $this->builder->selectAll($this->table);
    }

    public function select($fields,$condition)
    {
        return $this->builder->select($this->table,$fields,$condition);
    }

    public function create($parameters)
    {
        return $this->builder->insert($this->table,$parameters);
    }

    public function update($fields,$condition)
    {
        return $this->builder->update($this->table,$fields,$condition);
    }


    public function delete($condition)
    {
        return $this->builder->delete($this->table,$condition);

    }
}