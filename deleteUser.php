<?php

require_once("private/connection.php");
$id = $_GET['id'];
$random = $_GET['random'];

// Hoort de bezoeker hier uberhaupt wel te zijn?
if (!isset($_POST['delete'])) {
    header('Location: index.php');
}

if ($id == 1 || $id == 2) {
    header('Location: admin.php?delete=failure');
    exit();
} else {
    $query = "DELETE FROM gebruikers WHERE userid = '$id'";
    $result = mysqli_query($mysqli, $query) or die ('Error deleting');
    header("Location: admin.php?delete=success");
}