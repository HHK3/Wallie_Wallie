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
    echo 'lol';
    //Gebruiker mailen
    $to = $_POST['email'];
    $subject = 'Je wachtwoord terughalen voor de WALL';
    $message = 'Hier is je wachtwoord:';
    $message .= $row['password'];
    $headers = 'From: 25061@ma-web.nl';
    mail($to, $subject, $message, $headers) or die ('Error mailing.');
    header('Location: index.php?password_reset=success');

    exit();
} else {
    header('Location: index.php?password_reset=error');
    exit();
}


