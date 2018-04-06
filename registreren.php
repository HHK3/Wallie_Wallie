<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ Fotografie</title>
    <link rel="stylesheet" href="homestyle.css">
</head>
<body>

<div class="header">
    <div class="header-right">
        <button id="contact" onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Contact</button>    </div>
</div>

<img src="Images/Logo.png" alt="lol">
<h1>Welkom bij CJ Fotografie <br> Fotografeer & Deel</h1>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Registreren</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal1">
    <form class="modal-content animate" action="verwerk_registratie.php" method="post">
        <div class="imgcontainer">
            <span onclick="myFunction()" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">
            <h1>Registreren</h1>
            <p class="text">Vul de volgende gegevens in om in te registreren.</p>
            <hr>
            <br>
            <label for="username"><b>Gebruikersnaam</b></label>
            <input type="text" placeholder="Voer hier uw gebruikersnaam in" name="username" required autofocus>
            <br><br>
            <label for="mail"><b>Email</b></label>
            <input type="email" placeholder="Voer hier uw email in" name="mail" required>
            <br><br>
            <label for="password1"><b>Wachtwoord</b></label>
            <input type="password" placeholder="Voer hier uw wachtwoord in" name="password1" required>
            <br><br>
            <label for="password2"><b>Herhaal Wachtwoord</b></label>
            <input type="password" placeholder="Voer hier uw wachtwoord nog een keer in" name="password2" required>
            <button type="submit" name="submit">Registreren</button>
        </div>
    </form>
</div>
<br>


<div id="id02" class="modal2">

    <form class="modal-content animate" action="/verwerk_inloggen.php" method="post">
        <div class="imgcontainer">
            <span onclick="myFunction2()" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h1>Inloggen</h1>
            <p class="text">Vul de volgende gegevens in om in te loggen.</p>
            <hr>
            <br>
            <label for="username"><b>Gebruikersnaam</b></label>
            <input type="text" placeholder="Voer hier uw gebruikersnaam in" name="username" required>
            <br><br>
            <label for="password"><b>Wachtwoord</b></label>
            <input type="password" placeholder="Voer hier uw wachtwoord in" name="password" required>
            <button type="submit" name="submit">Login</button>
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
            <p class="text">U kunt contact opnemen met één van ons voor al uw vragen, opmerkingen etc.</p>
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

<script src="homepage.js"></script>

</body>
</html>
