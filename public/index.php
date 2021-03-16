<?php
session_start();

use app\engine\Autoload;
use app\engine\App;


include "../config/config.php";
include "../vendor/autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$config = include "../config/config.php";

try {

    App::call()->run($config);

} catch (\PDOException $exception) {
    var_dump($exception->getMessage());

} catch (\Exception $exception) {
    var_dump($exception->getTrace());
}







