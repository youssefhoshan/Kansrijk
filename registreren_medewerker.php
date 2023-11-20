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
        <form action="registratie_medewerker_verwerken.php" method="post">
            <label for="gebruikersnaam">Gebruikersnaam:</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required><br><br>

            <label for="wachtwoord">Wachtwoord:</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required><br><br>

            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
                <option value="medewerker">Medewerker</option>
                <option value="admin">Admin</option>
            </select><br><br>

            <input type="submit" value="Registreren">
        </form>
    </div>

    <?php include './components/footer.php'; ?>
</body>

</html>