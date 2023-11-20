<?php
require './components/db.php';

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the jongere from the database
    $deleteQuery = "DELETE FROM jongeren WHERE id = :id";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo 'Er is een fout opgetreden bij het verwijderen.';
    }
} else {
    echo 'ID niet opgegeven.';
}
?>
