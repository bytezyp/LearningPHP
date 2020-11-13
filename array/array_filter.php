<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-05
 * Time: 15:55
 */

$arr = ["a"=>2,"b"=>3, "c"=>4,"d"=>6];


function filter($val,$k){
//    var_dump($k,$val);
    if ($val>4){
        return $val;
    }
}

$brr = array_filter($arr, "filter", ARRAY_FILTER_USE_BOTH);

var_dump($brr);


