<?php


namespace app\controllers;


use app\engine\Request;
use app\engine\Session;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;

class BasketController extends Controller
{
    public function actionIndex() {
        $basket = (new BasketRepository())->getBasket(session_id());
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }

    public function actionDelete() {
        $error = "ok";
        $id = (new Request())->getParams()['id'];
        $session = new Session();
        $session_id = $session->id();

        $basket = (new BasketRepository())->getOne($id);

        if ($session_id == $basket->session_id) {
            (new BasketRepository())->delete($basket);
        } else {
            $error = "Нет прав";
        }


        $response = [
            'success' => $error,
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAdd() {
       // $id = (int)$_POST['id'];

        $id = (new Request())->getParams()['id'];

        $session_id = session_id();

        $basket = new Basket($session_id, $id);

        (new BasketRepository())->save($basket);

        $response = [
            'success' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}