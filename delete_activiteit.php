<?php
// Database Connection
require './components/db.php';

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['gebruikersnaam'])) {
    $gebruikersnaam = $_SESSION['gebruikersnaam'];

    // Check if ID is provided
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Delete the activiteit from the database
        $deleteQuery = "DELETE FROM activiteiten WHERE id = :id";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            header("Location: activiteiten_dashboard.php");
        } else {
            echo 'Er is een fout opgetreden bij het verwijderen.';
        }
    } else {
        echo 'ID niet opgegeven.';
    }
} else {
    // Als de gebruiker niet is ingelogd, stuur ze naar de inlogpagina
    echo 'U bent niet ingelogd! U wordt nu doorgestuurd naar de inlogpagina.';
    header("Refresh: 3; URL=login.php");
}
?>
