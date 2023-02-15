<?php
// Connexion à la base de données
$host = "MySQL:3306";
$user = "root";
$pass = "";
$db = "data";
$conn = mysqli_connect($host, $user, $pass, $db);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $nom = $_POST["pseudo"];
    $email = $_POST["email"];
    $mot_de_passe = $_POST["pswd"];
    $role = $_POST["role"];

    // Insérer les valeurs dans la base de données
    $query = "INSERT INTO player (pseudo, email, mot_de_passe, role) VALUES ('$pseudo', '$email', '$mot_de_passe', '$role')";
    mysqli_query($conn, $query);

    // // Rediriger l'utilisateur vers une page de confirmation
    // header("Location: confirmation.php");
    // exit();
}
?>
