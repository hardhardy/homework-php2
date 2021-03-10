<?php


namespace app\engine;

use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;


/**
 * Class App
 * @property Request $request
 * @property BasketRepository $basketRepository
 * @property UserRepository $usersRepository
 * @property ProductRepository $productRepository
 * @property Session $session
 * @property Db $db
 */
class App
{
    use TSingletone;

    public $config;
    private $components;

    private $controller;
    private $action;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function runController() {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action);
        } else {
            echo "Не правильный контроллер";
        }
    }

    public static function call()
    {
        return static::getInstance();
    }

    //создание компонента при обращении, возвращает объект для хранилища
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                //воспользуемся библиотекой ReflectionClass для создания класса
                //просто return new $class нельзя
                // т.к. не будут переданы параметры для конструктора
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);

            }
        }
        return null;
    }

    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    public function __get($name)
    {
        return $this->components->get($name);
    }

}