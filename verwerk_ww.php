<?php

require ('private/connection.php');

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['submit_ww'])) {
    header('Location: index.php');
}

//Bestaat dit mailadres al?
$query = "SELECT userid FROM gebruikers WHERE mailadres = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $mailadres);
$mailadres = $_POST['email'];
$result = $stmt->execute() or die ('Error querying');
$row = $stmt->fetch();
if ($row) {
    $stmt->close();
    $query1 = "INSERT INTO reset (resetid, mailadres, token) VALUES (0, ?, ?)";
    $stmt1 = $mysqli->prepare($query1);
    $stmt1->bind_param("ss", $mailadres, $token);
    $mailadres = $_POST['email'];
    $randomnumber = rand(0,1000000);
    $token = hash('sha512', $randomnumber);
    $result1 = $stmt1->execute() or die ('Error inserting token.');

    //Gebruiker mailen
    $to = $_POST['email'];
    $subject = 'Je wachtwoord terughalen voor de WALL';
    $message = 'Hey Wall gebruiker!<br><br>Jij hebt een wachtwoord wijziging aangevraagd op onze Wall website. Gebruik de volgende
                link om je wachtwoord te wijzigen: ';
    $message = 'http://25061.hosts.ma-cloud.nl/wall/verify_ww.php?mailadres=' . $mailadres . '&reset=' . $token;
    $message .= ' Als je niet een wachtwoord wijziging hebt aangevraagd, negeer dit bericht.<br><br> Met vriendelijke groet, <br><br>Joël & Chariesa';
    $headers = 'From: 25061@ma-web.nl';
    mail($to, $subject, $message, $headers) or die ('Error mailing.');
    header('Location: index.php?password_reset=success');
    exit();
} else {
    header('Location: index.php?password_reset=error');
    exit();
}


