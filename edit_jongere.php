<?php
require './components/db.php';

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch jongere data from the database
    $query = "SELECT * FROM jongeren WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $jongere = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$jongere) {
        echo 'Jongere niet gevonden.';
        exit();
    }
} else {
    echo 'ID niet opgegeven.';
    exit();
}

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $leeftijd = $_POST['leeftijd'];
    $wachtwoord = $_POST['wachtwoord'];

    // Hash het wachtwoord
    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    // Update the jongere in the database
    $updateQuery = "UPDATE jongeren SET naam = :naam, leeftijd = :leeftijd, wachtwoord = :wachtwoord WHERE id = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':naam', $naam, PDO::PARAM_STR);
    $updateStmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_INT);
    $updateStmt->bindParam(':wachtwoord', $hashedWachtwoord, PDO::PARAM_STR);
    $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: dashboard_medewerker.php");
    } else {
        echo 'Er is een fout opgetreden bij het bijwerken.';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Jongere</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php include 'components/header.php'; ?>
<body>
    <h1>Bewerk Jongere</h1>

    <form method="POST" action="">
        Naam: <input type="text" name="naam" value="<?php echo $jongere['naam']; ?>" required><br>
        Leeftijd: <input type="text" name="leeftijd" value="<?php echo $jongere['leeftijd']; ?>" required><br>
        Wachtwoord: <input type="password" name="wachtwoord" required><br>
        <input type="submit" value="Bijwerken">
    </form>
</body>
<?php include 'components/footer.php'; ?>
</html>
