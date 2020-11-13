<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-02-20
 * Time: 12:48
 */

$today = gmdate("Y-m-d H:i:s", time());
$today2 = gmdate("Y-m-d H:i:s", time() + 7*3600);
echo date_default_timezone_get()."\n";
var_dump($today,$today2);
var_dump(time());
var_dump(date_default_timezone_get());
var_dump("date_default_timezone_set Etc/GMT-8");
date_default_timezone_set("Etc/GMT-8");
var_dump(date_default_timezone_get());
var_dump(time());

$today = gmdate("Y-m-d H:i:s", time());
$today2 = gmdate("Y-m-d H:i:s", time() + 7*3600);
$date = date('Y-m-d H:i:s', time());
var_dump($today,$today2,$date);