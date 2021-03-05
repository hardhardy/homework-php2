<?php


namespace app\controllers;


use app\engine\Request;
use app\models\User;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

        if (User::auth($login, $pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Не верный логин пароль");
        }
    }

    public function actionLogout() {
        session_destroy();
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }

}