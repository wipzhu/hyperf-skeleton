<?php
/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/8/27
 * Time: 17:47
 */

namespace App\Controller;


use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Coroutine;
use Swoole\Coroutine\Channel;

/**
 * @Controller()
 */
class DemoController extends AbstractController
{
    /**
     * @RequestMapping(path="test", methods="get,post")
     * @author wipzhu
     */
    public function testDemo(RequestInterface $request)
    {
        $data = [
            'test' => 'test',
        ];
        dump($data);
    }


}