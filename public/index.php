<?php
session_start();


use app\engine\Render;
use app\engine\Request;
use app\engine\TwigRender;
use app\models\{Product, User};
use app\engine\Autoload;

//TODO сделать путь абсолютным
include "../config/config.php";
include "../engine/Autoload.php";
include "../vendor/autoload.php";



spl_autoload_register([new Autoload(), 'loadClass']);

$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
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