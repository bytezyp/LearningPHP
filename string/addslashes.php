<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-02-26
 * Time: 14:45
 */
$str = "['name'=>'张三','age'=>19]";

var_dump($str);

//对字符串进行转义

$a = addslashes($str);

//输出转义后的字符串
var_dump($a);

