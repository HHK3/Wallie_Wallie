<?php

require ('private/connection.php');

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['submit'])) {
    header('Location: registreren.php');
}

//Zijn beide wachtwoorden gelijk?
if ($_POST['password1'] != $_POST['password2']) {
    echo 'Je hebt twee verschillende wachtwoorden getypt.<br>';
    echo 'Klik <a href="registreren.php">hier</a> om terug te keren.';
    exit();
}

//Bestaat deze username al?
$query = "SELECT userid FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$result = $stmt->execute() or die ("Error querying");
$row = $stmt->fetch();
if ($row) {
    echo 'Sorry, maar deze gebruikersnaam is al bezet.<br>';
    echo 'Klik <a href="registreren.php">hier</a> om terug te keren.';
    exit();
}

//Bestaat dit mailadres al?
$query = "SELECT userid FROM users WHERE mailadres = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $mailadres);
$mailadres = $_POST['mailadres'];
$result = $stmt->execute() or die ('Error querying');
$row = $stmt->fetch();
if ($row) {
    echo 'Sorry, maar het lijkt erop dat je al een account hebt.<br>';
    echo 'Klik <a href="registreren.php">hier</a> om terug te keren.';
    exit();
}

//Gebruiker toevoegen aan database
$query = "INSERT INTO users VALUES (0, ?, ?, ?, ?, 0)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('ssss', $username, $mailadres, $hash, $password);
$username = $_POST['username'];
$mailadres = $_POST['mailadres'];
$randomnumber = rand(0,1000000);
$hash = hash('sha512', $randomnumber);
$password = hash('sha512', $_POST['password1']);
$result = $stmt->execute() or die ('Error inserting user.');

//Gebruiker mailen
$to = $_POST['mailadres'];
$subject = 'Verifieer je account bij THE WALL';
$message = 'Klik op de volgende link om je account te activeren:';
$message = 'http://25061.hosts.ma-cloud.nl/demo_registreren/verify.php?mailadres=' . $mailadres . '&hash=' . $hash;
$headers = 'From: 25061@ma-web.nl';
mail($to, $subject, $message, $headers) or die ('Error mailing.');

//Gelukt
echo 'Het registreren is gelukt! Er is nu een mail verzonden naar je emailadres, hiermee kan je jouw account bevestigen.<br>';
echo 'Klik <a href="registreren.php">hier</a> om terug te keren.';
exit();
