<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() {
        //TODO Передать сессию в модель
        $basket = Basket::getBasket();
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
}