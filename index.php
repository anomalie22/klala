<?php
session_start();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ip = trim($ipList[0]);
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if ($ip === "::1") $ip = "127.0.0.1"; 

file_put_contents('log.txt', "$ip\n", FILE_APPEND);
header("location: auth/");
?>
