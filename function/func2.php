<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-04
 * Time: 22:21
 */

$closure = function($name){
    return sprintf("Hello %s", $name);
};
echo $closure("jerry");
// 检测$closure变量是否是一个闭包
var_dump($closure instanceof Closure);

$aa = function (){
  echo "123";
};
// 这样也是一个闭包
var_dump($aa instanceof Closure);

