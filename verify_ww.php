<?php
session_start();
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if($fullUrl == 'http://25061.hosts.ma-cloud.nl/wall/verify_ww.php') {
    header('Location: index.php');
}

$mailadres = $_GET['mailadres'];

// Checken of mail klopt met token
require ('private/connection.php');
$query = "SELECT resetid, active FROM reset WHERE mailadres = ? AND token = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing for SELECT.');
$stmt->bind_param('ss', $mailadres, $token);
$mailadres = $_GET['mailadres'];
$token = $_GET['reset'];
$stmt->execute();
$stmt->bind_result($resetid, $active);
$row = $stmt->fetch();

if (!$resetid) {
    header('Location: index.php?verified_ww=failure');
    exit();
} else if ($active == 0) {
    header('Location: index.php?verified_ww=already_verified');
    exit();
}


$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ Fotografie</title>
    <link rel="stylesheet" href="homestyle2.css">
</head>
<body>

<div class="header">
</div>

<div class="modal5">
    <form class="modal-content animate" action="verwerk_verify_ww.php" method="post">
        <div class="container">
            <h1>Wachtwoord Wijzigen</h1>
            <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullUrl, "verified1_ww=error") == true) {
                echo '<p class="error">Je hebt twee verschillende wachtwoorden ingetypt. Probeer het opnieuw.</p>';
            }
            ?>
            <p class="text">Vul de volgende gegevens in om je wachtwoord te wijzigen.</p>
            <hr>
            <br>
            <label><b>Wachtwoord (Min. 6 tekens)</b></label>
            <input type="password" placeholder="Wachtwoord" name="password1" pattern=".{6,}" title="Zes of meer tekens" required>
            <br><br>
            <label for="password2"><b>Herhaal Wachtwoord</b></label>
            <input type="password" placeholder="Herhaal wachtwoord" name="password2" required>
            <input type="hidden" name="mailadres" value="<?= $mailadres; ?>" />
            <input type="hidden" name="token" value="<?= $token; ?>" />

            <button type="submit" name="submit_verify_ww">Wachtwoord wijzigen</button>
        </div>
    </form>
</div>


</body>
</html>

