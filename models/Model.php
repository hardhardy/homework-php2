<?php

namespace app\models;

use app\interfaces\IModels;
use app\engine\Db;


abstract class Model implements IModels
{

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
       return $this->$name;
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

//CRUD Active Record
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryOne($sql, ['id' => $id]);
       // return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }


    public function insert() {
        foreach ($this as $key => $value) {
            //TODO пропустить поле id и собрать $columns и $values и $params
            var_dump($key . " => " . $value);
        }
       //INSERT INTO {$this->getTableName()}(`name`, `description`, `price`) VALUES (:name, :description, :price
        $sql = "INSERT INTO {$this->getTableName()} ($columns) VALUES ($values)";
        //
        Db::getInstance()->execute($sql, $params);

        return $this;
    }

    public function update() {

    }

    public function delete() {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id"; //$this->id
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    //END CRUD

    abstract public function getTableName();
}