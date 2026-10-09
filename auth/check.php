<?php
require '../main.php';
$file = "status_" . $v_ip . ".txt";
if (file_exists($file)) {
    echo trim(file_get_contents($file));
} else {
    echo "wait";
}
?>