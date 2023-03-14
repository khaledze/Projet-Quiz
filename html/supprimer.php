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

// Récupération du pseudo du joueur à supprimer
$pseudo = $_POST['pseudo'];

// Suppression du joueur dans la base de données
$sql = "DELETE FROM player WHERE pseudo=:pseudo";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':pseudo', $pseudo);
$stmt->execute();

// Redirection vers la liste des joueurs
header("Location: joueurs.php");

// Fermeture de la connexion à la base de données
$conn = null;
?>