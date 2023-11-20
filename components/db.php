<?php
$servername = "localhost"; // de naam van de database server
$username = "root"; // jouw database gebruikersnaam
$password = ""; // jouw database wachtwoord
$database = "kansrijk"; // de naam van de database

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database verbinding is geslaagd.";
} catch(PDOException $e) {
    echo "Database verbinding is mislukt: " . $e->getMessage();
}
?>
