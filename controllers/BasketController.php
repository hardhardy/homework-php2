<?php


namespace app\controllers;


use app\engine\App;
use app\engine\Request;
use app\engine\Session;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;

class BasketController extends Controller
{
    public function actionIndex() {
        $basket = App::call()->basketRepository->getBasket(session_id());
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }

    public function actionDelete() {
        $error = "ok";
        $id = App::call()->request->getParams()['id'];

        $session_id = App::call()->session->id();

        $basket = App::call()->basketRepository->getOne($id);

        if ($session_id == $basket->session_id) {
            App::call()->basketRepository->delete($basket);
        } else {
            $error = "Нет прав";
        }


        $response = [
            'success' => $error,
            'count' => App::call()->basketRepository->getCountWhere('session_id', session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionAdd() {
       // $id = (int)$_POST['id'];

        $id = App::call()->request->getParams()['id'];

        $session_id = session_id();

        $basket = new Basket($session_id, $id);

        App::call()->basketRepository->save($basket);

        $response = [
            'success' => 'ok',
            'count' => App::call()->basketRepository->getCountWhere('session_id', session_id())
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}