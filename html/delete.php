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

// Vérification de la méthode de requête HTTP utilisée
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupération de l'id de la question à supprimer
    $id_question = $_POST['id'];
    $theme = $_POST['theme'];

    // Suppression de la question de la table "question"
    $sql_question = "DELETE FROM question WHERE id_question = ?";
    $stmt_question = mysqli_prepare($conn, $sql_question);
    mysqli_stmt_bind_param($stmt_question, "i", $id_question);
    mysqli_stmt_execute($stmt_question);

    // Suppression des choix associés à la question dans la table "choix"
    $sql_choix = "DELETE FROM choix WHERE id_question = ?";
    $stmt_choix = mysqli_prepare($conn, $sql_choix);
    mysqli_stmt_bind_param($stmt_choix, "i", $id_question);
    mysqli_stmt_execute($stmt_choix);

    // Redirection vers la page d'accueil avec un message de confirmation
    $_SESSION['message'] = "Question supprimée avec succès !";
    header("Location: quizz.php?theme=$theme");
    exit();
} else {
    // Redirection vers la page d'accueil en cas d'accès direct à la page delete.php
    header("Location: quizz.php");
    exit();
}
?>
