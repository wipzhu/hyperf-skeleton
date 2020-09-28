<?php
/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/8/27
 * Time: 17:47
 */

namespace App\Controller;


use App\Service\Redis1Service;
use App\Service\RedisService;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Guzzle\ClientFactory as GuzzleClientFactory;
use Hyperf\Guzzle\CoroutineHandler;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Coroutine;
use Hyperf\WebSocketClient\ClientFactory as WsClientFactory;
use Hyperf\WebSocketClient\Frame;
use Swoole\Coroutine\Channel;

/**
 * @Controller()
 */
class DemoController extends AbstractController
{
    /**
     * @Inject
     * @var WsClientFactory
     */
    protected $wsClientFactory;

    /**
     * @var GuzzleClientFactory
     */
    private $guzzleClientFactory;

    public function __construct(GuzzleClientFactory $guzzleClientFactory)
    {
        $this->guzzleClientFactory = $guzzleClientFactory;
    }

    /**
     * @RequestMapping(path="guzzle", methods="get,post")
     * @author wipzhu
     */
    public function guzzleTest(){
        $client = new Client([
            'base_uri' => 'http://127.0.0.1:9500',
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'timeout' => 5,
            'swoole' => [
                'timeout' => 10,
                'socket_buffer_size' => 1024 * 1024 * 2,
            ],
        ]);

        $response = $client->get('/');
        dump($response);
    }

    /**
     * @RequestMapping(path="test", methods="get,post")
     * @author wipzhu
     */
    public function testDemo(RequestInterface $request)
    {
        $container = ApplicationContext::getContainer();

        $redis = $container->get(Redis::class);
        $result = $redis->keys('*');
        dump($result);
    }

    /**
     * @RequestMapping(path="index", methods="get,post")
     * @return string
     * @author wipzhu
     */
    public function index()
    {
        // 对端服务的地址，如没有提供 ws:// 或 wss:// 前缀，则默认补充 ws://
        $host = '127.0.0.1:9502';
        // 通过 wsClientFactory 创建 Client 对象，创建出来的对象为短生命周期对象
        $client = $this->wsClientFactory->create($host);
        // 向 WebSocket 服务端发送消息
        $client->push('HttpServer 中使用 WebSocket Client 发送数据。');
        // 获取服务端响应的消息，服务端需要通过 push 向本客户端的 fd 投递消息，才能获取；以下设置超时时间 2s，接收到的数据类型为 Frame 对象。
        /** @var Frame $msg */
        $msg = $client->recv(2);
        // 获取文本数据：$res_msg->data
        return $msg->data;
    }

    /**
     * @RequestMapping(path="redis", methods="get,post")
     * @author wipzhu
     */
    public function redisTest()
    {
        $container = ApplicationContext::getContainer();

//        $redis = $container->get(\Hyperf\Redis\Redis::class);
        // 等同于
        $redis = $container->get(RedisService::class);


//        $redis->set('test_wipzhu', 'test_wipzhu', 60);
//        dump($redis->ttl('test_wipzhu'));

//        $redis->hMSet('user:1', ['name' => 'Joe', 'salary' => 2000]);
//        $redis->hMSet('hMSet', [
//            'test_wipzhu' => 'test_wipzhu',
//            'wipzhu' => 'wipzhu'
//        ]);
        dump($redis->hMGet('hMSet',['test_wipzhu', 'wipzhu']));
        dump($redis->hMGet('user:1', ['name', 'salary']));

        dump($redis->keys('*'));
    }

    /**
     * @RequestMapping(path="redis1", methods="get,post")
     * @author wipzhu
     */
    public function redis1Test()
    {
        $container = ApplicationContext::getContainer();

        $redis = $container->get(Redis1Service::class);

//        $redis->set('test_wipzhu', 'test_wipzhu', 60);
//        dump($redis->ttl('test_wipzhu'));

//        $redis->hMSet('user:1', array('name' => 'Joe', 'salary' => 2000));

        dump($redis->hMGet('hMSet',['test_wipzhu', 'wipzhu']));
        dump($redis->hMGet('user:1', ['name', 'salary']));

        dump($redis->keys('*'));
    }

}