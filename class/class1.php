<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-05
 * Time: 16:44
 */

class persion implements ArrayAccess {
    public $name = "sss";
    public function test()
    {
        echo "ssss";
    }
    public function __get($key)
    {
        return $this[$key];
    }
    public function __set($key, $value)
    {
        $this[$key] = $value;
    }
}


$var = [new persion(),"test"];

$pp = new persion();

var_dump($pp["name"]);


