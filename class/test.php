<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-11-13
 * Time: 15:21
 */


class test
{
    public function func()
    {
        echo __METHOD__;
        echo "---";
        echo __CLASS__;
    }
}

$tt = new test();
$tt->func();