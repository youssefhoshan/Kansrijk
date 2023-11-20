<?php
// Database Connection
require './components/db.php';

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['gebruikersnaam'])) {
    $gebruikersnaam = $_SESSION['gebruikersnaam'];
    // Display user-specific content here
} elseif (isset($_SESSION['admin'])) {
    // Display content for non-logged-in users
    echo 'Dit is een rare test voor admins!';
} elseif (isset($_SESSION['naam'])) {
    // Display content for non-logged-in users
    echo 'Dit is een rare test voor jongeren!';
} else {
    // Redirect to the login page if not logged in
    echo 'U bent niet ingelogd! U wordt nu doorgestuurd naar de inlogpagina.';
    header("Refresh: 3; URL=login.php");
}

// Include the header
include 'components/header.php';
?>

<h1>Dashboard</h1>

<h3>Welkom bij de dashboard! Waar jij kan zien wat er aan de hand is in het leven!</h3>

<!-- Tabel met activiteiten -->
<h2>Activiteiten</h2>
<table>
    <tr>
        <th>Naam</th>
    </tr>

    <?php
    // Fetch activiteiten data from the database
    $activiteitenQuery = "SELECT * FROM activiteiten";
    $activiteitenStmt = $pdo->prepare($activiteitenQuery);
    $activiteitenStmt->execute();

    while ($activiteit = $activiteitenStmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$activiteit['naam']}</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
// Include the footer
include 'components/footer.php';
?>
