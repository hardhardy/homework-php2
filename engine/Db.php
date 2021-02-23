<?php

namespace app\engine;

use app\traits\TSingletone;

class Db {
    use TSingletone;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3308',
        'login' => 'root',
        'password' => 'root',
        'database' => 'homework-php2',
        'charset' => 'utf8'
    ];
    private $connection = null; //PDO объект


    private function getConnection() {
        if (is_null($this->connection)) {
            $this->connection = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsnString() {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function lastInsertId() {
        //TODO вернуть id
    }

    private function query($sql, $params) {
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    private function queryOneObject($sql, $params, $class) {
        $stmt = $this->query($sql, $params);
        //TODO заставить работать корректно
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $stmt->fetch();
    }

    public function queryOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }

}