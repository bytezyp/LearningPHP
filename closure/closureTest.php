<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-01-23
 * Time: 18:27
 */

$cl = function () {
    return function ($arr) {
        echo $arr;
    };
};

//$cl()();

$pipe = 'abc';
[$name, $parameters] = array_pad(explode(':', $pipe, 2), 2, []);
var_dump($name, $parameters);
