<?php

class Human
{
    public $name;
    public $age;
    protected $health;


    public function __construct($name, $age, $health)
    {
        $this->name = $name;
        $this->age = $age;
        $this->health = $health;
    }


    public function sayName()
    {
        echo "Меня зовут " . $this->name;
    }
}

class Warrior extends Human {
    public $attack;

    public function __construct($name, $age, $health, $attack)
    {
        parent::__construct($name, $age, $health);
        $this->attack = $attack;
    }

    public function attack(Human $man) {
        $man->health -= $this->attack;
        echo "Воин наносит урон {$man->name} на " . $this->attack . " пукнтов.";
    }
}

class Doctor extends Human {

    public $skill;

    public function __construct($name, $age, $health, $skill)
    {
        parent::__construct($name, $age, $health);
        $this->skill = $skill;
    }

    public function heal(Human $man) {
        $man->health += $this->skill;
        echo "Доктор лечит {$man->name} на " . $this->skill . " пукнтов.";
    }

    public function sayName()
    {
        parent::sayName();
        echo "И я умею лечить на  " . $this->skill . ".";
    }

}

$man = new Human("Вася", 1, 80);
$doctor = new Doctor("Петя", 1, 50, 10);


$doctorHouse = new Doctor("Хаус", 1, 90, 1000);
$doctor->sayName();
$doctor->heal($doctorHouse);




