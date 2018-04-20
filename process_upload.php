<?php
require('private/connection.php');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

$allowed = array('jpg', 'jpeg', 'png', 'gif');


if(isset($_POST['submit'])) {
    //Image op de juiste locatie
    $temp_location = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $target_location = 'Images/' . time() . $name;
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];

    $ext = explode('.', $name);
    $fileActualExt = strtolower(end($ext));

    $title = $_POST['title'];
    $text = $_POST['text'];
    $username = $_COOKIE['username'];

    if (in_array($fileActualExt, $allowed)) {
        if  ($size < 10 * MB) {
            move_uploaded_file($temp_location, $target_location);
            $query = "INSERT INTO posts VALUES (0, ?, ?, ?, NOW(), ?)";
            $stmt = $mysqli->prepare($query) or die ('Error preparing');
            $stmt->bind_param('ssss', $title, $text, $target_location, $username) or die ('Error binding params');
            $stmt->execute() or die ('Error inserting image in database');
            $stmt->close();

            header('Location: upload.php?upload_process=success');
            exit();
        } else {
            header('Location: upload.php?upload_process=failure_size');
        }
    } else {
        header('Location: upload.php?upload_process=failure_type');
    }




}