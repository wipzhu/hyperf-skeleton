<?php
/**
 * Created by PhpStorm.
 * User: wipzhu
 * Date: 2020/8/27
 * Time: 17:59
 */


if (!function_exists('pr')) {
    /**
     * @desc 格式化输出调试信息
     * @param $arr
     * @author wipzhu
     * @update unknown
     */
    function pr($arr)
    {
        if (is_array($arr) || is_object($arr)) {
            if (!empty($arr)) {
                echo "<pre>";
                print_r($arr);
                echo "<pre/>";
            } else {
                echo "pr数组为空";
            }
        } else {
            echo "<pre>";
            var_dump($arr);
            echo "<pre/>";
        }
    }
}


if (!function_exists('dump')) {
    /**
     * @author Nicolas Grekas <p@tchwork.com>
     */
    function dump($var, ...$moreVars)
    {
        VarDumper::dump($var);

        foreach ($moreVars as $v) {
            VarDumper::dump($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        exit(1);
    }
}
