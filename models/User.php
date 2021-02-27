<?php

namespace app\models;

class User extends DbModel
{
    public $id = null;
    public $login;
    public $pass;


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }


    public static function getTableName() {
        return 'users';
    }

}