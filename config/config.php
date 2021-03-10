<?php

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;

return [
    'root_dir' => dirname(__DIR__),
    'templates_dir' => dirname(__DIR__) . "/views/",
    'controllers_namespaces' => 'app\\controllers\\',
    'product_per_page' => 2,
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => 'root',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'usersRepository' => [
            'class' => UserRepository::class
        ],
        'session' => [
            'class' => Session::class
        ]
    ]
];