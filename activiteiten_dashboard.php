<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteiten Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    // Database Connection
    require './components/db.php';

    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['gebruikersnaam'])) {
        $gebruikersnaam = $_SESSION['gebruikersnaam'];
        include 'components/header.php';
    ?>

    <h1>Activiteiten Dashboard</h1>

    <h3>Welkom bij het activiteiten dashboard! Hier kun je activiteiten beheren.</h3>

    <h2>Activiteiten</h2>

    <table class="activiteiten-table">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Acties</th>
        </tr>

        <?php
        // Fetch activiteiten data from the database using PDO
        $query = "SELECT * FROM activiteiten";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['naam']}</td>";
            echo "<td>
                    <form method='post' action='edit_activiteit.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='submit' value='Bewerk'>
                    </form>
                    <form method='post' action='delete_activiteit.php'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <input type='submit' value='Verwijder'>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>

<button> <a href="add_activiteit.php">Voeg Activiteit toe</a></button>

    <?php
    // Include the footer
    include 'components/footer.php';
    ?>

    <?php
    } elseif (isset($_SESSION['admin'])) {
        // Display content for non-logged-in users
        echo 'Dit is een rare test voor admins!';
    } elseif (isset($_SESSION['naam'])) {
        // Display content for non-logged-in users
        echo 'Je mag hier niet zijn!';
    } else {
        // Redirect to the login page if not logged in
        echo 'U bent niet ingelogd! U wordt nu doorgestuurd naar de inlogpagina.';
    }
    ?>
</body>

</html>
