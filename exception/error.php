<?php
/**
 * Created by PhpStorm.
 * User: zyp
 * Date: 2020-10-19
 * Time: 09:29
 */
function myCustomErrorHandler(int $errNo, string $errMsg, string $file, int $line) {
    echo "Wow my custom error handler got #[$errNo] occurred in [$file] at line [$line]: [$errMsg]";
}

set_error_handler('myCustomErrorHandler');
register_shutdown_function(function ($a) {
    var_dump($a);
    exit();
},22);
//aa();
try {
    what;
//    var_dump($q,111);
    aa();
} catch (Error $e) {
    var_dump($e->getCode());
    echo 'And my error is: ' . $e->getMessage();
}






