<?php
require_once './components/db.php';
// Start de sessie (als dit nog niet is gebeurd)
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
        <form action="login_medewerker.php" method="post">
            <label for="gebruikersnaam">Gebruikersnaam:</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br><br>

            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>

            <input type="submit" value="Inloggen">
        </form>
    </div>


    <?php include './components/footer.php'; ?>
</body>

</html>