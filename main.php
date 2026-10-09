<?php
ob_start();

error_reporting(0);

require (__DIR__).'/config.php';
require (__DIR__).'/lib/frm.php';
require (__DIR__).'/functions.php';
require (__DIR__).'/lang/getlang.php';

$v_ip = $_SERVER['REMOTE_ADDR'];

ob_end_clean();
?>