<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-16
 * Time: 18:56
 */

function a(&$b)
{
    $b++;
}
$c = 0;
call_user_func('a', $c);
echo $c;//显示 1
call_user_func_array('a', array(&$c));
echo $c;//显示 2


echo md5(123456);