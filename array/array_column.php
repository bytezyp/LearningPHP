<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-12-25
 * Time: 15:03
 */

// 一维数组
$arr = [
    'name' => 123,
];

$sum = array_column($arr,'name');
// 验证 array_column 只针对多维数组 如果不是一维数据，就返回空数组
//var_dump($sum);

// 参数不是数组，报警告错误
//$b = array_column('123', 'name');

//var_dump($b);
$brr = [$arr];
var_dump($brr);
$c = array_column($brr,'name','name');

var_dump($c);die();













