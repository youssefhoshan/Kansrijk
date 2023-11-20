<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div class="center_dashboard">
        <h1>Dashboard</h1>
        <h3>Welkom bij de dashboard! Waar jij alles kan aanpassen wat je wilt!</h3>
    </div>
   
    <!-- Link to switch to "activiteiten" table -->
    <a href="activiteiten_dashboard.php">Beheer activiteiten</a>

    <h2>Jongeren</h2>

    <table class="jongeren-table">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Leeftijd</th>
            <th>Acties</th>
        </tr>

        <?php
        // Fetch jongeren data from the database using PDO
        $query = "SELECT * FROM jongeren";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['naam']}</td>";
            echo "<td>{$row['leeftijd']}</td>";
            echo "<td><a href='edit_jongere.php?id={$row['id']}'>Bewerk</a> | <a href='delete_jongere.php?id={$row['id']}'>Verwijder</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div class="jongeren-form">
        <a href="add_jongere.php">Voeg een nieuwe jongere toe</a>
    </div>

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
