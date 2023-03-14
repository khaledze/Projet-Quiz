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

// Récupérer les données du formulaire de création de question
$new_question = mysqli_real_escape_string($conn, $_POST['new_question']);
$new_reponse1 = mysqli_real_escape_string($conn, $_POST['new_reponse1']);
$new_reponse2 = mysqli_real_escape_string($conn, $_POST['new_reponse2']);
$new_reponse3 = mysqli_real_escape_string($conn, $_POST['new_reponse3']);
$new_bonneReponse = mysqli_real_escape_string($conn, $_POST['new_bonneReponse']);
$theme = mysqli_real_escape_string($conn, $_POST['theme']);

// Insérer la question dans la table "question"
$sql = "INSERT INTO question (Question) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $new_question);
mysqli_stmt_execute($stmt);

// Récupérer l'ID de la dernière question insérée
$sql = "SELECT MAX(id_question) AS last_question_id FROM question";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$last_question_id = $row['last_question_id'];

// Insérer la réponse dans la table "choix" avec l'ID de la question
$sql = "INSERT INTO choix (id_question, theme, reponse1, reponse2, reponse3, bonneReponse) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "isssss", $last_question_id, $theme, $new_reponse1, $new_reponse2, $new_reponse3, $new_bonneReponse);
mysqli_stmt_execute($stmt);

// Rediriger vers la page des questions avec le thème sélectionné
header("Location: quizz.php?theme=$theme");
exit;

