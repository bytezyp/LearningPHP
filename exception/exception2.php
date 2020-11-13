<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-11-13
 * Time: 16:01
 */

class exTest3
{
    public function exTT()
    {
        try {
            $this->throwExcet();
        } catch (exception $e) {
            echo 'catch 捕获一个异常'.$e->getMessage();
        }
    }

    public function throwExcet()
    {
        throw new Exception("excep a test");
    }
}
// 这个内置函数作用是 设置顶层异常处理 可设置处理所有未捕获异常的用户定义函数。
set_exception_handler(function ($exception) {
    echo "  顶层捕获一个异常 Exception :".$exception->getMessage();
});

$t = new exTest3();
// 验证如果catch捕获到异常，顶层异常处理，就不会捕获
$t->exTT();
//$t->throwExcet();
