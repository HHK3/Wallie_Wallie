<?php
require ('private/connection.php');

$mailadres = $_POST['mailadres'];
$token = $_POST['token'];

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['submit_verify_ww'])) {
    header('Location: index.php');
}

//Zijn beide wachtwoorden gelijk?
if ($_POST['password1'] != $_POST['password2']) {
    header('Location: verify_ww.php?mailadres=' . $mailadres . '&reset=' . $token . '&verified1_ww=error');
    exit();
}

//Email link ongebruikelijk maken
$mailadres = $mysqli->real_escape_string($_POST['mailadres']) or die ('Error mail');
$query = "UPDATE reset SET active = 0 WHERE mailadres = '$mailadres'" ;
$stmt = $mysqli->prepare($query);
$result = $stmt->execute() or die ('Error making link unactive.');
$stmt->close();


//Gebruiker toevoegen aan database
$password = hash('sha512', $_POST['password1']) or die ('Error password');
$mailadres = $mysqli->real_escape_string($_POST['mailadres']) or die ('Error mail');
$query = "UPDATE gebruikers SET password = '$password' WHERE mailadres = '$mailadres'" ;
$stmt = $mysqli->prepare($query);
$result = $stmt->execute() or die ('Error inserting user.');
$stmt->close();

//Gelukt
header('Location: index.php?verified_ww=succesfull');
exit();
