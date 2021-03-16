<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\User;
use app\engine\App;

class UserRepository extends Repository
{
    public function auth($login, $pass) {
        $user = $this->getWhere('login', $login);


        if (password_verify($pass, $user->pass)) {
            App::call()->session->set('login', $login);
           // $_SESSION['auth']['login'] = $login;
           // $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    public function isAuth() {
        $login = App::call()->session->get('login');
        return isset($login);
    }

    public function getName() {
        return  App::call()->session->get('login');
    }


    protected function getTableName() {
        return 'users';
    }

    protected function getEntityClass()
    {
        return User::class;
    }
}