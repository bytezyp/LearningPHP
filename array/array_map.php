<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-10-10
 * Time: 14:23
 */
$arr = array("stringkey" => "value");
function cb1($a) {
    return array ($a);
}
function cb2($a, $b) {
    return array ($a, $b);
}
//var_dump(array_map("cb1", $arr));
//var_dump(array_map("cb2", $arr, $arr));
//var_dump(array_map(null,  $arr));
//var_dump(array_map(null, $arr, $arr));



$arr = [
    'a'=>1,
    'b'=>2,
    'c'=>3
];
$brr = [
    'a'=>4,
    'b'=>5,
    'c'=>6
];

array_walk($arr,function (&$v,$k,$prr){
//    var_dump($v,$k,$prr);
    if ($prr[$k]){
        $v = $prr[$k] + $v;
    }
}, $brr);

//var_dump($arr);

$aa = array_map(function($item){
    var_dump($item['key']);
    return $item['key'];
}, []);
//var_dump(11,$aa);

$str = implode(',', []);

//var_dump($str, 123);

$arr = [1,2,3];
$brr = [1,2,3];

if ($arr == $brr) {
    var_dump(true);
}else{
    var_dump(false);
}
echo '------------------------------'."\n";
$a = ['a'=> 11, 'b' => 22, 'c' => 33];
$b = [11,22,33];

$c = array_intersect($a, $b);
if ($a == $b) {
    var_dump(true);
}else{
    var_dump(false);
}
var_dump($c);

$a = true?12:1;
var_dump($a);















