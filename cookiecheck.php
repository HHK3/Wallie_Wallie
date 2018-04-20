<?php
// Checken of de userid, hash & username een match zijn in de db
require ('private/connection.php');
$query = "SELECT userid FROM gebruikers WHERE userid = ? AND hash = ? ";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param('is', $userid, $hash) or die ('Error binding params');
$stmt->bind_result($userid) or die ('Error binding results');
$userid = $_COOKIE['userid'];
$hash = $_COOKIE['hash'];
$stmt->execute() or die ('Error executing');
$fetch_succes = $stmt->fetch();

if (!$fetch_succes) {
    header('Location: verwerk_uitlog.php');
}