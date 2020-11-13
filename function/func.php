<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-04
 * Time: 18:10
 */

$str = "echo string";

// 匿名函数
$func = function () use ($str){
    $str = $str." 555";
    echo $str;
};

$func();








