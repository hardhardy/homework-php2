<?php
//TODO сделать путь абсолютным
include "../config/config.php";
include "../engine/Autoload.php";

use app\models\{Product, User};
use app\engine\Autoload;


spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
}








die();

$user = new User("user", "123");
$user->insert();
var_dump($user);



/**
 * @var Product $product
 */
$product = Product::getOne(3);

var_dump($product);



$product = new Product();

$product = $product->getOne(4);
$product->delete();




die();
//CREATE
$product = new Product("Чай", "Цейлонский", 22);

$product->save();

//READ
$product = Product::getAll();


//DELETE

$product = Product::getOne(5);
$product->delete();

//UPDATE
$product = Product::getOne(5);
$product->name = "Чай!2";
$product->save();