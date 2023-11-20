<?php
// Include the database connection
require_once './components/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $plain_password = $_POST['wachtwoord']; // Plain text password
    $rol = $_POST['rol'];

    // Hash the plain text password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $bestaat_sql = "SELECT COUNT(*) as count FROM medewerkers WHERE gebruikersnaam = :gebruikersnaam";

    $stmt = $pdo->prepare($bestaat_sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Username already exists
            echo "Deze gebruikersnaam is al in gebruik. Kies een andere gebruikersnaam.";
        } else {
            // Insert the new user into the database with the hashed password
            $insert_sql = "INSERT INTO medewerkers (gebruikersnaam, wachtwoord, rol) VALUES (:gebruikersnaam, :wachtwoord, :rol)";

            $stmt = $pdo->prepare($insert_sql);
            $stmt->bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);
            $stmt->bindParam(':wachtwoord', $hashed_password, PDO::PARAM_STR); // Store the hashed password
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Registration successful
                echo "Registratie gelukt. U kunt nu inloggen <a href='index_medewerker.php'>hier</a>.";
            } else {
                // Database query error
                echo "Er is een fout opgetreden bij de registratie. Probeer het later opnieuw.";
            }
        }
    }
}
?>
