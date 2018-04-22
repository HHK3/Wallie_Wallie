<?php
session_start();

if (isset($_COOKIE['userid']) OR isset($_SESSION['userid'])) {
    header('Location: wall.php');
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ Fotografie</title>
    <link rel="stylesheet" href="homestyle.css">
    <meta charset="UTF-8">
</head>
<body>

<div class="topnav" id="myTopnav">
    <a href="index.php" class="active">Home</a>
    <a onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Contact</a>
    <a href="javascript:void(0);" style="font-size:16px;" class="icon" onclick="myFunction7()" id="icon">&#9776;</a>
</div>

<img src="Images/Logo.png" alt="lol">
<h1 id="welkom">Welkom bij CJ Fotografie</h1>

<div class="parent">
<button onclick="document.getElementById('id01').style.display='block'" style="width:110px;" class="inline">Registreren</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:110px;" class="inline">Login</button>
</div>
<div id="id01" class="modal1">
    <form class="modal-content animate" id="register" action="verwerk_registratie.php" method="post">
        <div class="imgcontainer">
            <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">
            <h1>Registreren</h1>
            <p class="text">Vul de volgende gegevens in om in te registreren.</p>
            <hr>
            <br>
            <label for="username"><b>Username (Min. 4 tekens & Max. 12 tekens)</b></label>
            <input type="text" placeholder="Username" name="username" pattern=".{4,12}" title="Min. 4 & Max. 12 tekens" required autofocus>
            <br><br>
            <label for="mail"><b>Email</b></label>
            <input type="email" placeholder="Email" name="mail" required>
            <br><br>
            <label for="password1"><b>Wachtwoord (Min. 6 tekens)</b></label>
            <input type="password" placeholder="Wachtwoord" name="password1" pattern=".{6,}" title="Zes of meer tekens"required>
            <br><br>
            <label for="password2"><b>Herhaal Wachtwoord</b></label>
            <input type="password" placeholder="Herhaal wachtwoord" name="password2" required>
            <button type="submit" name="submit_reg">Registreren</button>
        </div>
    </form>
</div>
<br>


<div id="id02" class="modal2">

    <form class="modal-content animate" id="login" action="verwerk_inloggen.php" method="post">
        <div class="imgcontainer">
            <span onclick="myFunction2()" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h1>Inloggen</h1>
            <p class="text">Vul de volgende gegevens in om in te loggen.</p>
            <hr>
            <br>
            <label for="username_log"><b>Username</b></label>
            <input type="text" placeholder="Username" name="username_log" required>
            <br><br>
            <label for="password"><b>Wachtwoord</b></label>
            <input type="password" placeholder="Wachtwoord" name="password" required>
            <button type="submit" name="submit_log">Login</button>
        </div>
    </form>

</div>

<div id="id03" class="modal3">
    <div class="modal-content animate" >
        <div class="imgcontainer">
            <span onclick="myFunction3()" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h1>Contact</h1>
            <p class="text1">Je kan contact opnemen met één van ons voor al je vragen, opmerkingen etc.</p>
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

    if (strpos($fullUrl, "login=error") == true) {
        echo '    <div class="parent">
                <button onclick="document.getElementById(\'id04\').style.display=\'block\'" style="width:110px;" class="inline">Wachtwoord vergeten?</button>
                </div>
                <div id="id04" class="modal4">
                     <form class="modal-content animate" action="verwerk_ww.php" method="post">
                        <div class="imgcontainer">
                            <span onclick="myFunction4()" class="close" title="Close Modal">&times;</span>
                        </div>
                        <div class="container">
                            <h1>Wachtwoord vergeten?</h1>
                            <p class="text">Vul je Email in en je ontvangt per Email instructies hoe je een nieuw wachtwoord aanmaakt.</p>
                            <hr>
                            <br>
                            <label for="email"><b>Email</b></label>
                            <input type="email" placeholder="Email" name="email" required>
                            <button type="submit" name="submit_ww">Mail versturen</button>
                        </div>
                       </form>
                    </div>
                   
                    <p class="error">Ongeldige username/wachtwoord combo. Probeer het opnieuw.</p>';

    } else if (strpos($fullUrl, "login=unverified") == true) {
        echo '<p class="error">Je account is nog niet geverifieerd. Bekijk je E-mail om je account te activeren.</p>';
    } else if (strpos($fullUrl, "register=username_error") == true) {
        echo '<p class="error">Je getypte username is al in gebruik. Probeer een ander username.</p>';
    }  else if (strpos($fullUrl, "register=password_error") == true) {
        echo '<p class="error">Je hebt twee verschillende wachtwoorden ingetypt. Probeer het opnieuw.</p>';
    }  else if (strpos($fullUrl, "register=email_error") == true) {
        echo '<p class="error">Je getypte emailadres is al in gebruik. Probeer een ander emailadres.</p>';
    }  else if (strpos($fullUrl, "register=succesfull") == true) {
        echo '<p class="success">Je account is aangemaakt! Ga naar je E-mail om je account te bevestigen.</p>';
    }  else if (strpos($fullUrl, "password_reset=success") == true) {
        echo '<p class="success">Er een mail naar je Email verstuurd. Bekijk het om je wachtwoord te wijzigen.</p>';
    } else if (strpos($fullUrl, "password_reset=error") == true ) {
        echo '<div class="parent">
                <button onclick="document.getElementById(\'id04\').style.display=\'block\'" style="width:110px;" class="inline">Wachtwoord vergeten?</button>
                </div>
                <div id="id04" class="modal4">
                     <form class="modal-content animate" action="verwerk_ww.php" method="post">
                        <div class="imgcontainer">
                            <span onclick="myFunction4()" class="close" title="Close Modal">&times;</span>
                        </div>
                        <div class="container">
                            <h1>Wachtwoord vergeten?</h1>
                            <p class="text">Vul je Email in en je ontvangt per Email instructies hoe je een nieuw wachtwoord aanmaakt.</p>
                            <hr>
                            <br>
                            <label for="email"><b>Email</b></label>
                            <input type="email" placeholder="Email" name="email" required>
                            <button type="submit" name="submit_ww">Mail versturen</button>
                        </div>
                       </form>
                    </div>
                    <p class="error">Er bestaat geen account met het getype Email. Probeer het opnieuw.</p>';
    }  else if (strpos($fullUrl, "verified=succesfull") == true) {
        echo '<p class="success">Het verifieren van jouw account is gelukt! Je kan nu inloggen!</p>';
    }  else if (strpos($fullUrl, "verified=error") == true) {
        echo '<p class="error">Sorry, maar deze combo van mailadres en hash ken ik niet.</p>';
    }  else if (strpos($fullUrl, "verified_ww=failure") == true) {
        echo '<p class="error">Sorry, maar deze combo van mailadres en token ken ik niet.</p>';
    }  else if (strpos($fullUrl, "verified_ww=succesfull") == true) {
        echo '<p class="success">Je hebt je wachtwoord met succes gewijzigd!</p>';
    }   else if (strpos($fullUrl, "verified_ww=already_verified") == true) {
        echo '<div class="parent">
                <button onclick="document.getElementById(\'id04\').style.display=\'block\'" style="width:110px;" class="inline">Wachtwoord vergeten?</button>
                </div>
                <div id="id04" class="modal4">
                     <form class="modal-content animate" action="verwerk_ww.php" method="post">
                        <div class="imgcontainer">
                            <span onclick="myFunction4()" class="close" title="Close Modal">&times;</span>
                        </div>
                        <div class="container">
                            <h1>Wachtwoord vergeten?</h1>
                            <p class="text">Vul je Email in en je ontvangt per Email instructies hoe je een nieuw wachtwoord aanmaakt.</p>
                            <hr>
                            <br>
                            <label for="email"><b>Email</b></label>
                            <input type="email" placeholder="Email" name="email" required>
                            <button type="submit" name="submit_ww">Mail versturen</button>
                        </div>
                       </form>
                    </div>
                    <p class="error">Deze link is al gebruikt. Probeer opnieuw.</p>';
    }
?>

<script src="homepage2.js"></script>

</body>
</html>

