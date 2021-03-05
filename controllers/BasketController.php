<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() {
        $basket = Basket::getBasket(session_id());
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }

    public function actionAdd() {
       // $id = (int)$_POST['id'];

        $id = (new Request())->getParams()['id'];

        $session_id = session_id();

        (new Basket($session_id, $id))->save();

        $response = [
            'success' => 'ok',
            'count' => Basket::getCountWhere('session_id', session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}