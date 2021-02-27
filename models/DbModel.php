<?php


namespace app\models;


use app\engine\Db;

abstract class DbModel extends Model
{
    abstract public static function getTableName();

    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getLimit($limit) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);
     }

//CRUD Active Record
    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        // return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }


    public function insert() {
        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = $value;
            $columns[] = $key;
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        $tableName = static::getTableName();
        //INSERT INTO {$this->getTableName()}(`name`, `description`, `price`) VALUES (:name, :description, :price
        $sql = "INSERT INTO {$tableName} ($columns) VALUES ($values)";

        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();

        return $this;
    }

    public function update() {

    }

    public function delete() {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id"; //$this->id
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    //END CRUD

    public function save() {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }


}