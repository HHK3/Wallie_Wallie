<?php
session_start();

//Checken of de gebruiker wel admin is
if (!isset($_SESSION['userid'])) {
    if (!isset($_COOKIE['userid'])) {
        header('Location: verwerk_uitlog.php');
    } else {
        require('cookiecheck.php');
        $_SESSION['userid'] = $_COOKIE['userid'];
        $_SESSION['hash'] = $_COOKIE['hash'];
        $_SESSION['username'] = $_COOKIE['username'];

    }
} else{
    if ($_SESSION['username'] != 'HooHahKong') {
        header('Location: wall.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="topnav" id="myTopnav">

    <a href="admin.php" class="active">Admin</a>
    <a href="wall.php">Wall</a>
    <a href="upload.php">Upload</a>
    <a href="geupload.php">Mijn geuploade foto's</a>
    <a onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Contact</a>

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
            <p class="text1">U kunt contact opnemen met een van ons voor al uw vragen, opmerkingen etc.</p>
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
$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullUrl, "delete=failure") == true) {
    echo '<p class="error">Je gaat toch geen Admin verwijderen?! >=(</p>';
} else if (strpos($fullUrl, "delete=success") == true) {
    echo '<p class="success">Je hebt de gebruiker met succes verwijderd!</p>';
} else if (strpos($fullUrl, "delete_photo=success") == true) {
    echo '<p class="success">Je hebt de foto met succes verwijderd!</p>';
}
?>
<div class="main-wrapper">
<div class="masonry">
<?php
require("private/connection.php");

$randomnumber = rand(0,1000000);
$hash = hash('sha512', $randomnumber);
$query = "SELECT * FROM gebruikers";
$result = mysqli_query($mysqli, $query) or die ('kan resultaten niet naar voren halen');

echo "<table>";
echo "<tr>";
echo "<td>ID</td><td>Gebruikersnaam</td><td>Mailadres</td><td>DELETEN</td><td>WALL</td></td>";
echo "</tr>";

while ($row = mysqli_fetch_array($result)) {
    $id = $row['userid'];
    $username = $row['username'];
    $username = htmlentities($username);
    $mailadres = $row['mailadres'];
    $mailadres = htmlentities($mailadres);

    echo "<tr>";
    echo "<td>$id</td><td>$username</td><td>$mailadres</td></td>";
    echo "<td>";
    echo '<form method="post"><a href="deleteUser.php?id=' . $id . '&random=' . $hash . '" name="delete">DELETE</a></form>';
    echo "</td>";
    echo "<td>";
    echo '<a href="wall2.php?id=' . $id . '&username=' . $username  . '&mailadres=' . $mailadres . ' ">BEKIJK</a>';
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($mysqli);
?>
</div>
</div>
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