<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2019-01-16
 * Time: 16:04
 */


$user = 'admin';
$pwd = password_hash($user, PASSWORD_BCRYPT);

echo $pwd;






