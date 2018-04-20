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

<?php
require ('private/connection.php');

$query = "SELECT postid, title, text, picture, DATE_FORMAT(datum, '%d %M %Y'), username FROM posts ORDER BY postid DESC";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_result($id, $title, $text, $picture, $date, $username) or die ('Error binding resukts');
$stmt->execute() or die ('Error executing');
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="wall.css">
</head>
<body>

<div class="topnav" id="myTopnav">
    <a href="wall.php" class="active">Wall</a>
    <a href="upload.php">Upload</a>
    <a href="geupload.php">Mijn geuploade foto's</a>
    <a onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Contact</a>
    <?php
        if ($_SESSION['username'] == 'HooHahKong') {
        echo '<a href="admin.php">Admin</a>';
        }
    ?>
    <a href="verwerk_uitlog.php">Uitloggen</a>
    <a id="hallo">Hallo  <?php echo $_SESSION['username']?>!</a>
    <a href="javascript:void(0);" style="font-size:18px;" class="icon" onclick="myFunction7()" id="icon">&#9776;</a>
</div>

<div id="id03" class="modal3">
    <div class="modal-content animate" >
        <div class="imgcontainer">
            <span onclick="myFunction3()" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h1>Contact</h1>
            <p class="text1">U kunt contact opnemen met één van ons voor al uw vragen, opmerkingen etc.</p>
            <hr>
            <br>
            <div id="grid">
                <label for="Joel"><b>Joel</b></label>
                <label for="Chariesa"><b>Chariesa</b></label>
                <p><b>Email: </b>25061@ma-web.nl</p>
                <p><b>Email: </b>15982@ma-web.nl</p>
            </div>
        </div>
    </div>
</div>

<?php
echo '<div class="main-wrapper">';
echo '<div class="masonry">';
while ($succes = $stmt->fetch()) {
    echo '<button id="clickImg' . $id . '" class="item"> <img id="img' . $id . '" class="foto"  src="' . $picture . '" /> </button>';
    echo '<div id="modalImg' . $id . '" class="modal" style="display: none"> 
            
            <div class="modal-c">
                            <span id="close" class="close' . $id . '">X</span>
                           <br>
                <div class="modal-b">
                    <h1 class="mdTit">' . htmlentities($title) . '</h1>
                    <p class="mdTex">' . htmlentities($text) . '</p>
                    <img class="mdImg" src="' . htmlentities($picture) . '" style=" height: 400px;" />
                    <hr>
                    <p class="mdUs"> Geupload door: ' . htmlentities($username) . '</p>
                    <p class="mdDat"> Geplaatst op: ' . htmlentities($date) . '.</p>
                    </div>
                    </div>
                    </div>';

    echo '<script>
            var modalImg' . $id . ' = document.getElementById("modalImg' . $id . '");
            var clickImg' . $id . ' = document.getElementById("clickImg' . $id . '");
            var close' . $id . ' = document.getElementsByClassName("close' . $id . '")[0];

            clickImg' . $id . '.addEventListener("click", openMD' . $id . ');
            close' . $id . '.addEventListener("click", closeMD' . $id . ');
            window.addEventListener("click", clickAway' . $id . ');

            function openMD' . $id . '() {
                modalImg' . $id . '.style.display = "block";
               }

            function closeMD' . $id . '() {
                modalImg' . $id . '.style.display = "none";
               }

            function clickAway' . $id . '(e) {
                if(e.target == modalImg' . $id . ')
                modalImg' . $id . '.style.display = "none";
               }
            </script>';
}

echo '</div>';
echo '</div>';

//?>
<script>
    function myFunction7() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
<script src="homepage.js"></script>
</body>
</html>
