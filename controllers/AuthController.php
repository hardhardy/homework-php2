<?php


namespace app\controllers;


use app\engine\Request;
use app\models\repositories\UserRepository;
use app\engine\App;


class AuthController extends Controller
{
    public function actionLogin() {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];

        if (App::call()->usersRepository->auth($login, $pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Не верный логин пароль");
        }
    }

    public function actionLogout() {
        App::call()->session->destroy();
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }

}