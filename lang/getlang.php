<?php

$lng = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if ($lng === 'en') {
    require (__DIR__).'/lib/en.php';
}elseif($lng === 'es'){
    require (__DIR__).'/lib/en.php';
}elseif($lng === 'de'){
    require (__DIR__).'/lib/de.php';
}elseif($lng === 'fr'){
    require (__DIR__).'/lib/fr.php';
}



?>
