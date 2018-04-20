<?php
session_start();
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if($fullUrl == 'http://25061.hosts.ma-cloud.nl/wall/verify_ww.php') {
    header('Location: index.php');
}

$mailadres = $_GET['mailadres'];
// Checken of mail klopt met token
require ('private/connection.php');
$query = "SELECT resetid FROM reset WHERE mailadres = ? AND token = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing for SELECT.');
$stmt->bind_param('ss', $mailadres, $token);
$mailadres = $_GET['mailadres'];
$token = $_GET['reset'];
$stmt->execute();
$stmt->bind_result($resetid);
$row = $stmt->fetch();

if (!$resetid) {
    header('Location: index.php?verified_ww=failure');
    exit();
}
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ Fotografie</title>
    <link rel="stylesheet" href="homestyle.css">
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
            <p class="text">Vul de volgende gegevens in om in te registreren.</p>
            <hr>
            <br>
            <label for="password1"><b>Wachtwoord</b></label>
            <input type="password" placeholder="Voer hier uw wachtwoord in" name="password1" required>
            <br><br>
            <label for="password2"><b>Herhaal Wachtwoord</b></label>
            <input type="password" placeholder="Voer hier uw wachtwoord nog een keer in" name="password2" required>
            <input type="hidden" name="mailadres" value="<?= $mailadres; ?>" />;



            <button type="submit" name="submit_verify_ww">Wachtwoord wijzigen</button>
        </div>
    </form>
</div>


</body>
</html>

    <input type="hidden" name="email_address" value="<?php echo $_POST['email_address'];?> />;
