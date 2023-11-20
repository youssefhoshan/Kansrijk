<?php


// Start the session
session_start();

require './components/db.php';

// Check if the form is submitted for adding
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];

    // Insert the new jongere into the database
    $insertQuery = "INSERT INTO activiteiten (naam) VALUES (:naam)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindParam(':naam', $naam, PDO::PARAM_STR);

    if ($insertStmt->execute()) {
        header("Location: activiteiten_dashboard.php");
    } else {
        echo 'Er is een fout opgetreden bij het toevoegen.';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Activiteit Toe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php include 'components/header.php'; ?>
<body>
    <h1>Voeg Jongere Toe</h1>

    <form method="POST" action"">
        Naam: <input type="text" name="naam" required><br>
        <input type="submit" value="Toevoegen">
    </form>
</body>
<?php include 'components/footer.php'; ?>
</html>
