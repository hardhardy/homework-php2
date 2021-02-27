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


}