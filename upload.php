<?php

session_start();

//Checken of de gebruiker verdwaald is
if (!isset($_SESSION['userid'])) {
    if (!isset($_COOKIE['userid'])) {
        header('Location: verwerk_uitlog.php');
    } else {
        require('cookiecheck.php');
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['hash'] = $_COOKIE[ 'hash'];
        $_SESSION['username'] = $_COOKIE[ 'username'];
    }
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="upload.css">

</head>
<body>

<div class="topnav" id="myTopnav">
    <a href="upload.php" class="active">Upload</a>
    <a href="wall.php">Wall</a>
    <a href="geupload.php">Mijn foto's</a>
    <?php
        if ($_SESSION['username'] == 'HooHahKong') {
            echo '<a href="admin.php">Admin</a>';
        }
    ?>
    <a href="verwerk_uitlog.php">Uitloggen</a>
    <a id="hallo">Hallo  <?php echo $_SESSION['username']?>!</a>

    <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="myFunction7()" id="icon">&#9776;</a>
</div>

<h1>Foto uploaden</h1>
<div class="main-wrapper">
    <div class="masonry">
<form enctype="multipart/form-data" method="post" action="process_upload.php" >
    <input type="file" name="image" accept="image/*" onchange="preview_image(event)" required/><br><br>
    <img src="preview.png" id="preview"><br><br>
    <label for="title" id="labelTit">Titel</label><span class="text-muted pull-right" id="count1">20</span>
    <br>
    <textarea name="title" id="title" cols="21" maxlength="20" onkeyup="count_down1(this);"></textarea><br>
    <label for="text" id="labelTex">Count Down</label><span class="text-muted pull-right" id="count2">30</span><br>
    <textarea class="form-control" name="text" cols="30" maxlength="30" onkeyup="count_down(this);"></textarea>
    <br>

    <input type="submit" value="Uploaden!" name="submit">
</form>

<?php
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullUrl, "upload_process=failure_type") == true) {
    echo '<p class="error">Ongeldige bestandstype (geen JPEG, PNG of GIF). Probeer het opnieuw.</p>';
} else if (strpos($fullUrl, "upload_process=failure_size") == true) {
    echo '<p class="error">De foto is groter dan 10MB. Kies voor een andere foto die kleiner is dan 10MB.</p>';
}else if (strpos($fullUrl, "upload_process=success") == true) {
    echo '<p class="success">Je foto is geupload! Bekijk het snel in de Wall!</p>';
}
    ?>

<script src="homepage.js"></script>
<script>


    function count_down(obj) {

        var element = document.getElementById('count2');

        element.innerHTML = 30 - obj.value.length;

        if (30 - obj.value.length < 0) {
            element.style.color = 'red';

        } else {
            element.style.color = 'grey';
        }

    }

    function count_down1(obj) {

        var element = document.getElementById('count1');

        element.innerHTML = 20 - obj.value.length;

        if (30 - obj.value.length < 0) {
            element.style.color = 'red';

        } else {
            element.style.color = 'grey';
        }

    }
    function preview_image(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }


</script>
    </div></div>
</body>
</html>


