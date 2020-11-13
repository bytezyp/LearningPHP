<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-09-16
 * Time: 15:12
 */

$arr = array(
    array("10",11,100,100,"a"),
    array(1,2,"2",3,1)
);


array_multisort($arr[0],SORT_ASC, SORT_STRING,
                    $arr[1],SORT_DESC,SORT_NUMERIC);

//var_dump($arr);
//die();
$users = [
    ['name' => 'tom','age'=>'20'],
    ['name' => 'anny','age'=>'18'],
    ['name' => 'Jack','age'=>'22'],
    ['name' => 'Tim','age'=>'234'],
    ['name' => 'Tim3','age'=>'2'],
];

$ages = [];
foreach ($users as $user) {
    $ages[] = $user['age'];
}
$name = [];
foreach ($users as $user) {
    $name[] = $user['name'];
}
// 字母是根据ASSCII表对应的
array_multisort(array_column($users,'age'), SORT_ASC, $users);
echo '----------------------';
var_dump($users);
die();

function Arr_sort($arr, $order_id, $order_date)
{
    if ($order_id =='asc') {
        $order_id = SORT_ASC;
    } else {
        $order_id = SORT_DESC;
    }
    $date = [];
    foreach ($arr as $value) {
        $date[] = $value['date'];
    }
    array_multisort($date, $order_id, $arr);
}


