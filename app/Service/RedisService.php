<?php
/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/9/25
 * Time: 16:46
 */

namespace App\Service;


use Hyperf\Redis\Redis;

class RedisService extends Redis
{
    // 对应的 Pool 的 key 值
    protected $poolName = 'default';
}