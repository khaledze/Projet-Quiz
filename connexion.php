<?php

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$userType = $_POST["userType"];

// Connexion à la base de données
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "quiz";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Insertion des données dans la table player
$sql = "INSERT INTO player (username, email, password, userType)
VALUES ('$username', '$email', '$password', '$userType')";

if (mysqli_query($conn, $sql)) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion des données : " . mysqli_error($conn);
}

mysqli_close($conn);

?>
