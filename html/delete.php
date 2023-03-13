<?php
session_start(); // Démarrage de la session

$host = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8');

if (isset($_GET['id']) && isset($_GET['theme'])) {
    $id = $_GET['id'];
    $theme = htmlspecialchars($_GET['theme']);

    $sql = "DELETE FROM choix WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: quizz.php?theme=" . urlencode($theme));
    exit;
} else {
    echo "Erreur : paramètres manquants.";
    exit;
}
?>
