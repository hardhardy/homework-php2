<?php


namespace app\controllers;


use app\models\Product;

class ProductController
{
    //TODO вынести общий функционал в родителя Controller в абстрактный класс
    private $action;
    private $defaultAction = 'index';
    private $defaultLayout = 'main';
    private $useLayout = true;

    public function runAction($action = null)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);

        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;
        $catalog = Product::getAll();
        //$catalog = Product::getLimit(($page + 1) * 2);


        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];

        $good = Product::getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->defaultLayout}", [
                'menu' => $this->renderTemplate('menu', $params),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }

    }

    //['catalog' => $catalog]
    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        if (file_exists($templatePath)) {
            include $templatePath;
        }

        return ob_get_clean();
    }


}