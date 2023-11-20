<?php
require './components/db.php';

// Check if the form is submitted for adding
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $leeftijd = $_POST['leeftijd'];
    $wachtwoord = $_POST['wachtwoord'];

    // Hash the wachtwoord
    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // Insert the new jongere into the database
    $insertQuery = "INSERT INTO jongeren (naam, leeftijd, wachtwoord) VALUES (:naam, :leeftijd, :wachtwoord)";
    $insertStmt = $pdo->prepare($insertQuery);
    $insertStmt->bindParam(':naam', $naam, PDO::PARAM_STR);
    $insertStmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_INT);
    $insertStmt->bindParam(':wachtwoord', $hashedWachtwoord, PDO::PARAM_STR);

    if ($insertStmt->execute()) {
        header("Location: dashboard_medewerker.php");
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
    <title>Voeg Jongere Toe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php include 'components/header.php'; ?>
<body>
    <h1>Voeg Jongere Toe</h1>

    <form method="POST" action="">
        Naam: <input type="text" name="naam" required><br>
        Leeftijd: <input type="text" name="leeftijd" required><br>
        Wachtwoord: <input type="password" name="wachtwoord" required><br>
        <input type="submit" value="Toevoegen">
    </form>
</body>
<?php include 'components/footer.php'; ?>
</html>
