<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-01-13
 * Time: 11:12
 */

/**
 *  php 默认是格林威治时区 也就是零时区
 */
date_default_timezone_set("Asia/Shanghai");
$date = date('Y-m-d H:i:s',time());

var_dump($date);

print_r(date_default_timezone_get());

// gmdate 直接返回 零时区 格林威治时区的时间
$date1 = gmdate("Y-m-d H:s:i", time());

var_dump($date1);


