<?php


namespace app\controllers;


use app\engine\Render;
use app\interfaces\IRenderer;
use app\models\Basket;
use app\models\User;

class Controller
{
    //TODO вынести общий функционал в родителя Controller в абстрактный класс
    private $action;
    private $defaultAction = 'index';
    private $defaultLayout = 'main';
    private $useLayout = true;

    private $renderer;


    public function __construct(IRenderer $render)
    {
        $this->renderer = $render;
    }


    public function runAction($action = null)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->defaultLayout}", [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => User::isAuth(),
                    'userName' => User::getName(),
                    'count' => Basket::getCountWhere('session_id', session_id())
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }

    }

    //['catalog' => $catalog]
    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}