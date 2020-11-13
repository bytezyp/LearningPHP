<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-01-25
 * Time: 17:59
 */

function urlsafe_b64encode($string){
    $data = base64_encode($string);
    $data = str_replace(array('+','/'),array('-','_',''),$data);
    return $data;
}
$a = urlsafe_b64encode('请你不要再迷恋哥');

var_dump($a);
function urlsafe_b64decode($string){
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data)%4;
    if ($mod4) {
        $mod4 .= substr('===',$mod4);
    }
    return base64_decode($data);
}


$a = urlsafe_b64decode("ecqna2GLKjE");

var_dump($a);


