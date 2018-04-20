<?php
require_once("private/connection.php");

$postid = $_GET['photo_id'];
$file = $_GET['picture'];

unlink($file);
$query = "DELETE FROM posts WHERE postid = '$postid' ";
$result = mysqli_query($mysqli, $query) or die ('Error deleting');
header("location: geupload.php?delete_photo=success ");
