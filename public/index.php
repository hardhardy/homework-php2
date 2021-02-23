<?php
//TODO сделать путь абсолютным
include "../config/config.php";
include "../engine/Autoload.php";

use app\models\{Product, User};
use app\engine\Autoload;


spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product("Чай", "Цейлонский", 22);
$product->insert();
var_dump($product);


die();

$product = new Product();

$product = $product->getOne(4);
$product->delete();




die();
//CREATE
$product = new Product("Чай", "Цейлонский", 22);

$product->insert();

//READ
$product = new Product();
$product->getOne(5);
$product->getAll();

//DELETE
$product = new Product();
$product->getOne(5);
$product->delete();

//UPDATE
$product = new Product();
$product->getOne(5);
$product->name = "Чай!2";
$product->update();