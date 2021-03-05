<?php

namespace app\models;

class User extends DbModel
{
    protected $id = null;
    protected $login;
    protected $pass;

    protected $props = [
        'login' => false,
        'pass' => false
    ];


    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function auth($login, $pass) {
        $user = User::getWhere('login', $login);

       //echo password_hash("123", PASSWORD_DEFAULT);
        //password_verify($pass, $user->pass);

        if ($pass == $user->pass) {
            $_SESSION['auth']['login'] = $login;
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    public static function isAuth() {
        return isset($_SESSION['auth']['login']);
    }

    public static function getName() {
        return $_SESSION['auth']['login'];
    }


    public static function getTableName() {
        return 'users';
    }

}