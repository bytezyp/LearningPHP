<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-10-14
 * Time: 19:32
 */



function xrange($start,$max){
    for ($i= $start; $i < $max;$i++) {
        yield $i => 123;

    }
}
$range = xrange(1,55);
foreach ($range as $key =>$item) {
//    var_dump($key);
    if ($key ==4) {
        var_dump($key);
    }

}
echo 123;
foreach ($range as $key => $item) {
    var_dump($key);
}