<?php

require ('private/connection.php');

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['submit_reg'])) {
    header('Location: index.php');
}

//Zijn beide wachtwoorden gelijk?
if ($_POST['password1'] != $_POST['password2']) {
    header('Location: index.php?register=password_error');
    exit();
}

//Bestaat deze username al?
$query = "SELECT userid FROM gebruikers WHERE username = ?";
$stmt = $mysqli->prepare($query)  or die ("Error prep1");
$stmt->bind_param('s', $username);
$username = $_POST['username'];
$result = $stmt->execute() or die ("Error querying1");
$row = $stmt->fetch(); //or die ('fetch1');
if ($row) {
    header('Location: index.php?register=username_error');
    exit();
};

//Bestaat dit mailadres al?
$query = "SELECT userid FROM gebruikers WHERE mailadres = ?";
$stmt = $mysqli->prepare($query)  or die ("Error prep2");
$stmt->bind_param('s', $mailadres)  or die ("Error bind2");
$mailadres = $_POST['mail'];
$result = $stmt->execute() or die ('Error querying2');
$row = $stmt->fetch(); // or die ('fetch2');
if ($row) {
    header('Location: index.php?register=email_error');
    exit();
}

//Gebruiker toevoegen aan database
$query = "INSERT INTO gebruikers VALUES (0, ?, ?, ?, ?, 0)";
$stmt = $mysqli->prepare($query)  or die ("Error prep3");
$stmt->bind_param('ssss', $username, $mailadres, $hash, $password)  or die ("Error bind3");
$username = $_POST['username'];
$mailadres = $_POST['mail'];
$randomnumber = rand(0,1000000);
$hash = hash('sha512', $randomnumber);
$password = hash('sha512', $_POST['password1']);
$result = $stmt->execute() or die ('Error inserting user.');

//Gebruiker mailen
$to = $_POST['mail'];
$subject = 'Verifieer je account bij THE WALL';
$message = 'Klik op de volgende link om je account te activeren:';
$message = 'http://25061.hosts.ma-cloud.nl/wall/verify.php?mailadres=' . $mailadres . '&hash=' . $hash;
$headers = 'From: 25061@ma-web.nl';
mail($to, $subject, $message, $headers) or die ('Error mailing.');

//Gelukt
header('Location: index.php?register=succesfull');
exit();
