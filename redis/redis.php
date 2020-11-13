<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-12-31
 * Time: 14:52
 */

$redis = new redis();

$redis->connect("192.168.12.200","6379");

echo $redis->ping();

$iterator = null;
$num = 0;
while ($values = $redis->scan($iterator, "*report*cod_ratio",500)){
    foreach ($values as $item) {
        $num++;
    }
}
echo $num;





