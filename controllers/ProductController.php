<?php


namespace app\controllers;


use app\engine\Request;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{


    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'] ?? 0;
        $catalog = (new ProductRepository())->getLimit(($page + 1) * PRODUCT_PER_PAGE);


        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = (int)(new Request())->getParams()['id'];

        $good = (new ProductRepository())->getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }



}