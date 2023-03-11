<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connexion réussie";
} catch(PDOException $e) {
    echo "<script>alert('connexion echoué !');</script>" . $e->getMessage();
}

// Récupération de tous les joueurs
$sql = "SELECT * FROM player";
$stmt = $conn->prepare($sql);
$stmt->execute();
$joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des joueurs
echo "<h1>Liste des joueurs :</h1>";
echo "<table>";
foreach($joueurs as $joueur) {
    echo "<tr>";
    echo "<td><strong>" . $joueur['pseudo'] . "</strong> (" . $joueur['email'] . ") - Rôle : " . $joueur['role'] . "</td>";
    echo "<td><form method='post' action='modifier.php'>";
    echo "<input type='hidden' name='pseudo' value='" . $joueur['pseudo'] . "'>";
    echo "<input type='hidden' name='email' value='" . $joueur['email'] . "'>";
    echo "<input type='hidden' name='role' value='" . $joueur['role'] . "'>";
    echo "<input type='hidden' name='password' value='" . $joueur['password'] . "'>";
    echo "<input type='submit' value='Modifier'>";
    echo "</form></td>";
    echo "<td><form method='post' action='supprimer.php'>";
    echo "<input type='hidden' name='pseudo' value='" . $joueur['pseudo'] . "'>";
    echo "<input type='submit' value='Supprimer'>";
    echo "</form></td>";
    echo "</tr>";
}
echo "</table>";

// Fermeture de la connexion à la base de données
$conn = null;
?>


