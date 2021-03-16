<?php

namespace app\models\entities;

use app\models\Model;

class User extends Model
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


}