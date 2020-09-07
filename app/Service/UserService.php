<?php
/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/8/21
 * Time: 16:06
 */

namespace App\Service;


use Hyperf\DbConnection\Db;

class UserService
{
    /**
     * @author wipzhu
     * @param $userId
     * @return mixed
     */
    public function getInfoById($userId)
    {
        return Db::table('hp_user')->where('id', $userId)->get();
    }

}