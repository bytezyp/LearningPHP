<?php

function urlsafe_b64decode($string) {
    $data = str_replace(array('-', '_'), array('+', '/'), $string);
    $mod4 = strlen($data) % 4;
    var_dump($data);
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    var_dump($data);
    return base64_decode($data);
}


function decrypter($encrypt_message, $e_key, $i_key) {
    $decode_data = urlsafe_b64decode($encrypt_message);
    echo $decode_data;
    var_dump(111111,strlen($decode_data));
    echo "-----------";
    // $decode_data = "WroH4wAHiwMAAAAAAAAAALilQXFPbnrBiGNKWQ";
    $iv = substr($decode_data, 0, 16);
    var_dump($iv);
    $p = substr($decode_data, 16, 8);
    var_dump($p);
    $sig = substr($decode_data, 24, 4);
    var_dump($sig);
    $price_pad = substr(hash_hmac("sha1", $iv, $e_key, true), 0, 8);
    $price = $p ^ $price_pad;
    var_dump($price,"----",strlen($price),$price_pad);
    $conf_sig = hash_hmac("sha1", $price . $iv, $i_key, true);
    if (substr($conf_sig, 0, 4) != $sig) {
        return false;
    }
    var_dump(unpack("N2", $price),$price);
    list($high, $low) = array_values(unpack("N2", $price));
    $price = $high << 32 | $low;
    var_dump($price);
    return $price;
}

$e_key = "ce7a8033fc93417e88dddabf34cc703f";
$i_key = "be980f628658b114d500a322eb222dec";
foreach (["WroH4wAHiwMAAAAAAAAAALilQXFPbnrBiGNKWQ"] as $msg) {
    echo decrypter($msg, $e_key, $i_key) . PHP_EOL;
}


