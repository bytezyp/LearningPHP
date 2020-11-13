<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-04-18
 * Time: 15:22
 */
//初始化变量
$condition = array(33,44);
//key是and ，值是[11,22]
$condition[] = array("11", 22);

print_r($condition);

print_r(json_encode($condition));


// 空数组测试 测试 array_column
$arr = [];

$a = array_column($arr, 'name');
echo "\n----\n";
print_r($a);

$b = array_sum(array_column($arr, 'name'));

echo '-----\n';
var_dump($b);
