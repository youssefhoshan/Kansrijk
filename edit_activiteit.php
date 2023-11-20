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

        // Fetch activiteit data from the database
        $query = "SELECT * FROM activiteiten WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $activiteit = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$activiteit) {
            echo 'Activiteit niet gevonden.';
            exit();
        }
    } else {
        echo 'ID niet opgegeven.';
        exit();
    }

    // Check if the form is submitted for updating
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $naam = $_POST['naam'];

        // Update the activiteit in the database
        $updateQuery = "UPDATE activiteiten SET naam = :naam WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':naam', $naam, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            header("Location: activiteiten_dashboard.php");
        } else {
            echo 'Er is een fout opgetreden bij het bijwerken.';
        }
    }
} else {
    // Als de gebruiker niet is ingelogd, stuur ze naar de inlogpagina
    echo 'U bent niet ingelogd! U wordt nu doorgestuurd naar de inlogpagina.';
    header("Refresh: 3; URL=login.php");
}
?>
