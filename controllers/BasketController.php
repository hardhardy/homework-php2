<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() {
        $session_id = session_id();
        $basket = Basket::getBasket($session_id);
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
}