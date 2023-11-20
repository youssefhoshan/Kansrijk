<?php
// Include the database connection
require_once './components/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $plain_password = $_POST['wachtwoord']; // Plain text password
    $leeftijd = $_POST['leeftijd'];

    // Hash the plain text password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $bestaat_sql = "SELECT COUNT(*) as count FROM jongeren WHERE naam = :naam";

    $stmt = $pdo->prepare($bestaat_sql);
    $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Username already exists
            echo "Deze naam is al in gebruik. Kies een andere naam.";
        } else {
            // Insert the new user into the database with the hashed password
            $insert_sql = "INSERT INTO jongeren (naam, wachtwoord, leeftijd) VALUES (:naam, :wachtwoord, :leeftijd)";

            $stmt = $pdo->prepare($insert_sql);
            $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
            $stmt->bindParam(':wachtwoord', $hashed_password, PDO::PARAM_STR); // Store the hashed password
            $stmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Registration successful
                echo "Registratie gelukt. U kunt nu inloggen <a href='index.php'>hier</a>.";
            } else {
                // Database query error
                echo "Er is een fout opgetreden bij de registratie. Probeer het later opnieuw.";
            }
        }
    }
}
?>
