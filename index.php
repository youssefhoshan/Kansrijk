<?php
require_once './components/db.php';
// Start de sessie
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <?php include './components/header.php'; ?>
    <title>Page Title</title>
    <link rel="stylesheet" type="text/css" href="./components/style.css">
</head>

<body>

    <div class="inloggen-div">
        <h1>Inloggen - Jongeren Kansrijker</h1>
        <form action="login.php" method="post">
            <label for="naam">naam:</label> <br>
            <input type="text" id="naam" placeholder="Uw naam..." name="naam" required><br><br>

            <label for="wachtwoord">Wachtwoord:</label> <br>
            <input type="password" id="wachtwoord" placeholder="Uw Wachtwoord..." name="wachtwoord" required><br><br>

            <input type="submit" value="Inloggen">
            <button><a href="index_medewerker.php">Voor Medewerkers</a></button>
        </form>
    </div>


    <?php include './components/footer.php'; ?>
</body>

</html>