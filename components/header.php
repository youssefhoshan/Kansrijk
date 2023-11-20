<!DOCTYPE html>
<html>
<head>
    <title>Jongeren Kansrijker</title>
    <link rel="stylesheet" type="text/css" href="./components/style.css">
</head>
<body>
    <div class="header">
        <a href="home.php">
            <img src="./components/logo.png" alt="Jongeren Kansrijker Logo">
        </a>
        <div class="user-info">
            <?php
            require_once './components/db.php';

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
             // Start de sessie
            // Controleer of de gebruiker is ingelogd en haal de naam op
            
            // Check if the user is logged in
            if (isset($_SESSION['naam'])) {
                // User is logged in, display their name
                echo "Welkom, " . $_SESSION['naam'];
            } elseif(isset($_SESSION['gebruikersnaam'])) {
                echo "Welkom, " . $_SESSION['gebruikersnaam'];
            }
            
            else {
                // User is not logged in, display a generic welcome message
                echo "Welkom, Gast";
            }
            ?>
        </div>
        <div class="header-links">
            <?php
            // Als de gebruiker is ingelogd, toon een uitlogknop
            if (isset($_SESSION['naam'])) {
                echo "<a href='uitloggen.php'>Uitloggen</a>";
            } elseif (isset($_SESSION['gebruikersnaam'])) {
                echo "<a href='uitloggen.php'>Uitloggen</a>";
            }
            
            else {
                // Als de gebruiker niet is ingelogd, toon inlog- en registratielinks
                echo "<a href='index.php'>Inloggen</a>";
                echo " | ";
                echo "<a href='registratie.php'>Registreren</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
