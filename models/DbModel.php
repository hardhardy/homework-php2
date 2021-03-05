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

   public static function getWhere($name, $value) {
       $tableName = static::getTableName();
       $sql = "SELECT * FROM {$tableName} WHERE `{$name}`=:value";
       return Db::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
   }

    public static function getCountWhere($name, $value)  {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
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

        foreach ($this->props as $key => $value) {
            $params[":{$key}"] = $this->$key;
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
        $params = [];
        $colums = [];
        foreach ($this->props as $key => $value) {
            if (!$value) continue;
            $params[":{$key}"] = $this->$key;
            $colums[] .= "`{$key}` = :{$key}";
            $this->props[$key] = false;
        }
        $colums = implode(", ", $colums);
        $tableName = static::getTableName();
        $params['id'] = $this->id;

        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";
        Db::getInstance()->execute($sql, $params);
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