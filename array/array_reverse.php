<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2018-12-25
 * Time: 16:45
 */

$input  = array("php", 4.0, array("green", "red"));
$reversed = array_reverse($input);
$preserved = array_reverse($input, true);

//print_r($input);
//print_r($reversed);
//print_r($preserved);


// 将键值组合的顺序颠倒
print_r(array_reverse(["aa" => 11, "bb" => 22, "cc" => 33], true));