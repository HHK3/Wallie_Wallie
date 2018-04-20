<?php
session_start();

if (!isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600);
}

$_SESSION = array();
session_destroy();

if (isset($_COOKIE['userid'])) {
    setcookie('userid', '', time() - 3600);
    setcookie('hash', '', time() - 3600);
    setcookie('username', '', time() - 3600);
}


header('Location: index.php');