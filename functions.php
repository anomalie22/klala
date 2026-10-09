<?php 
function call($msg){
    global $token;
    global $id;
    $c = curl_init('https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$id.'&text='.urlencode($msg));
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($c);
    curl_close($c);
    return $res;
}



?>