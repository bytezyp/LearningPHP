<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-01-24
 * Time: 10:19
 */
# example
$str = 'aaa,bbb,ccc';
$arr = explode(',', $str);
# 第三参数是默认值,分割个数没有限制
var_dump($arr);

# example 1
$str = 'abc, 222';
$arr = explode(',', $str, 2);
# 正常情况, 分割限制数量有限制，相等
var_dump($arr);

# example 2
$str = 'abc, 222, ddd';
$arr = explode(',', $str, 2);
# 限制个数，会从第一个分割，开始计数，大于
var_dump($arr);

# example 3
$str = 'aaa,bbb,ccc';
$arr = explode(',', $str, 4);
# 限制个数，会和不限制，效果一样
var_dump($arr);