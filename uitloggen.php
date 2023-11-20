<?php
// Start de sessie
session_start();

// Vernietig de sessie om uit te loggen
session_destroy();

// Stuur de gebruiker terug naar de inlogpagina
header("Location: index.php");
?>
