<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-11-13
 * Time: 15:48
 */


class exTest
{
    public function t1()
    {
        try {
//            $this->t2();
            var_dump(aa());
        } catch (\Throwable $e) {

            echo 'message:'.$e->getMessage().'--code:'.$e->getCode();
        }
    }

    public function t2()
    {
        throw new Exception("in t2 exception");
    }
}
function err($errno, $errstr, $errfile, $errline) {
    var_dump($errno, $errstr, $errfile, $errline);
    var_dump(123);
    return true;
}
set_exception_handler("err");
trigger_error("Incorrect input vector, array of values expected", E_USER_WARNING);

//$ett = new exTest();
//$ett->t1();
