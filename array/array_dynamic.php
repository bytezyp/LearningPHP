<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-09-15
 * Time: 17:30
 */


function fibonacci($n)
{
    if ($n <= 0) {
        return $n;
    }
    $a = [];
    for ($i=0;$i <= $n; $i++) {
        $a[$i] = -1;
    }
    return fib($n, $a);
}

function fib($n, $a)
{
    if ($a[$n] != -1) {
        return $a[$n];
    }
    if ($n <=2) {
        $a[$n] =1;
    }else{
        $a[$n] = fib($n-1, $a) + fib($n-2, $a);

    }
    return $a[$n];
}
fibonacci(2);
//var_dump(fibonacci(2));
$n = 15;
$a[0] = 0;

for ($i =1;$i <= $n; $i++) {
    $cost = 10000000000;
    if ($i-1 >= 0) {
        $cost = min($cost, $a[$i-1]+1);
    }
    if ($i-5 >= 0) {
        $cost = min($cost, $a[$i-5]+1);
    }
    if ($i-11 >= 0) {
        $cost = min($cost, $a[$i-11]+1);
    }
    $a[$i] = $cost;
    var_dump($i."-----".$a[$i]);
}




