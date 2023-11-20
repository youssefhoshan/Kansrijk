<?php
// Start de sessie (als dit nog niet is gebeurd)
session_start();
require_once './components/db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registreren - Jongeren Kansrijker</title>
    <link rel="stylesheet" type="text/css" href="./components/style.css">
</head>

<body>
    <?php include './components/header.php';
    session_start();
    ?>
    

    <div class="inloggen-div">
        <h1>Registreren - Jongeren Kansrijker</h1>
        <form action="registratie_verwerken.php" method="post">
            <label for="naam">Uw Naam:</label> <br>
            <input type="text" id="naam" placeholder="Uw naam..." name="naam" required> <br><br>

            <label for="wachtwoord">Wachtwoord:</label><br>
            <input type="password" id="wachtwoord" placeholder="Uw Wachtwoord..." name="wachtwoord" required><br><br>

            <label for="leeftijd">Leeftijd:</label><br>
            <input type="number" name="leeftijd" id="leeftijd" required><br><br>


            <input type="submit" value="Registreren">
        </form>
    </div>

    <?php include './components/footer.php'; ?>
</body>

</html>