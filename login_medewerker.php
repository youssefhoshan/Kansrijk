<?php
// start the session
session_start();
// Include the database connection
require_once './components/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $plain_password = $_POST['wachtwoord']; // Plain text password

    // Retrieve the hashed password from the database
    $sql = "SELECT wachtwoord FROM medewerkers WHERE gebruikersnaam = :gebruikersnaam";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':gebruikersnaam', $gebruikersnaam, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $hashed_password = $result['wachtwoord'];
        
            // Verify the password using password_verify()
            if (password_verify($plain_password, $hashed_password)) {
                // Password is correct, login successful
                // Store the username in the session
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
        
                // Redirect to the dashboard or user-specific page
                header("Location: dashboard_medewerker.php");
                exit;
            } else {
                // Invalid password
                echo "Ongeldige gebruikersnaam of wachtwoord. Probeer opnieuw.";
            }
        } else {
            // User not found
            echo "Ongeldige gebruikersnaam of wachtwoord. Probeer opnieuw.";
        }
    } else {
        // Database query error
        echo "Er is een fout opgetreden bij het inloggen. Probeer het later opnieuw.";
    }
}
?>
