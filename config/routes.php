<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET'], '/index/info', 'App\Controller\IndexController@info');

// 该 Group 下的所有路由都将应用配置的中间件
Router::addGroup('/v2', function () {
    Router::get('/index/profile', [\App\Controller\IndexController::class, 'profile']);
},
    ['middleware' => [\App\Middleware\Auth\AuthMiddleware::class]]
);