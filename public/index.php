<?php
session_start();

use app\engine\Render;
use app\engine\TwigRender;
use app\engine\Request;
use app\engine\Autoload;

//TODO сделать путь абсолютным
include "../config/config.php";
//include "../engine/Autoload.php";
include "../vendor/autoload.php";

try {
    spl_autoload_register([new Autoload(), 'loadClass']);

    $request = new Request();

    $controllerName = $request->getControllerName() ?: 'product';
    $actionName = $request->getActionName();

    $controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new TwigRender());
        $controller->runAction($actionName);
    }

} catch (\PDOException $exception) {
    var_dump($exception->getMessage());

} catch (\Exception $exception) {
    var_dump($exception->getTrace());
}







