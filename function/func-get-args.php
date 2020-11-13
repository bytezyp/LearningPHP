<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-10
 * Time: 17:11
 */

function get(){
    $var = func_get_args();
    var_dump($var);
}

get("demo:123");
