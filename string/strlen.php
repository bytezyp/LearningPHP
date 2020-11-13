<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-01-05
 * Time: 19:48
 */

echo strlen("123yu中");
echo "\n";
echo mb_strlen("123yu中");

$str = "123yu中";
$len = strlen($str);
for ($i=0; $i <= $len-1; $i++) {
    var_dump($str[$i],ord($str[$i]));
}
