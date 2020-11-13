<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2018-12-25
 * Time: 16:10
 */


$arr = [111, 222, 333];


$res = array_reduce($arr, function ($carray, $iterm) {
//    var_dump($carray, $iterm);
    return $carray . $iterm;
}, $carray = "aaa");

//var_dump($res);

/*
 *
 *  array_reduce(array, callback, initial) 函数需要三个参数：
 *  参数1：是待处理的数组，
 *  参数2：是用于合并逻辑的回调函数，函数需要两个参数
 *      一个参数是carray, 上次迭代里的值；如果本次迭代是第一次，那么这个值是initial
 *      另一个参数是item，细带了本次迭代的值。
 *  参数3：迭代初始值，该参数将在处理开始前使用，或者当处理结束，数组为空时最后一个结果。
 *
 *
 * */


$pipes = [
    'a' => function ($poster, $callback){
        echo 'func 111 ';
        var_dump($poster);
        $poster += 1;
        return $callback($poster);
    },
    'b' => function ($poster, $callback) {
        echo 'func 222  ';
        $result = $callback($poster);
        return $result - 1;
    },
    'c' => function ($poster, $callback){
        echo 'func 333  ';
        $poster += 2 ;
        return $callback($poster);
    }
];
//var_dump(array_reverse($pipes));
class test {

    public function then(Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->pipes), $this->done(), $this->prepareDestination($destination)
        );
        var_dump($pipeline);
        return $pipeline($this->passable);
    }

    function done()
    {
        return function ($stack, $pipe) {
//            var_dump($stack,'---------', $pipe, '+++++++++');
            return function ($passable) use($stack, $pipe) {
//                var_dump($passable.'00000', '=====');
                return $pipe($passable, $stack);
            };
        };
    }
    function prepareDestination(Closure $destination)
    {
        return function ($passable) use ($destination) {
            return $destination($passable);
        };
    }
    public function through($pipes)
    {
        $this->pipes = is_array($pipes) ? $pipes : func_get_args();
        return $this;
    }

}


$ret = new test();
//$func = $ret->done();
//$func(11,33)();
$ret->through($pipes)->then(function ($content) {
    var_dump(666,$content.'+++11');
});
//var_dump($ret);