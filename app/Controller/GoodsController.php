<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/8/21
 * Time: 16:03
 */

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Controller()
 */
class GoodsController extends AbstractController
{
    /**
     * @RequestMapping(path="goods-list", methods="get,post")
     * @author wipzhu
     */
    public function goods_list(RequestInterface $request)
    {
//        echo $_GET['brief'];
        var_dump($request->all());
//        exit();
//        $brief = $request->input('brief', 'This is goods list page.');
//        return (string)$brief;

    }

}