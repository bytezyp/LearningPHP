<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-12-17
 * Time: 20:06
 */
$arr = [
    1 => [
        "a" => 111,
        "b" => 222,
        "c" => 333,
    ],
    2 => [
        "a" => 222,
        "b" => 222,
        "c" => 333,
    ],
    3 => [
        "a" => 333,
        "b" => 222,
        "c" => 333,
    ],
];

$brr = [];

$crr = array_column(array_merge($arr, $brr),null,'a');

var_dump($crr, array_merge($arr,$brr));




