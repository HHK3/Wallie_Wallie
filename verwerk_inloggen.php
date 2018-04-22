<?php

session_start();

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['submit_log'])) {
    header('Location: index.php');
}


// Checken of de gebruiker bestaat (en of zijn wachtwoord klopt)
require ('private/connection.php');
$query = "SELECT userid, hash, active FROM gebruikers WHERE username = ? AND password = ?";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param('ss', $username, $password) or die ('Error binding params');
$stmt->bind_result($userid, $hash, $active) or die ('Error binding results');
$username = $_POST['username_log'];
$password = $_POST['password'];
$password = hash('sha512', $password) or die ('Error hashing.');
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();

if (!$fetch_succes) {
    header('Location: index.php?login=error');
    exit();

} else if ($active == 0) {
    header('Location: index.php?login=unverified');
    exit();
}

setcookie('userid', $userid, time() + 3600 * 24 * 7);
$_SESSION['userid'] = $userid;

setcookie('hash', $hash, time() + 3600 * 24 * 7);
$_SESSION['hash'] = $hash;

setcookie('username', $username, time() + 3600 * 24 * 7);
$_SESSION['username'] = $username;

header('Location: wall.php');
?>
