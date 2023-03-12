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

// Sélectionner le plus grand ID dans la table "choix"
$max_id_sql = "SELECT MAX(id) FROM choix";
$max_id_result = mysqli_query($conn, $max_id_sql);
$max_id_row = mysqli_fetch_array($max_id_result);
$max_id = $max_id_row[0];

// Si la table "choix" est vide, initialiser l'ID à 1
if ($max_id === null) {
  $max_id = 1;
} else {
  $max_id++; // incrémenter l'ID
}

// Sélectionner le plus grand ID de question dans la table "question"
$max_question_id_sql = "SELECT MAX(id_question) FROM question";
$max_question_id_result = mysqli_query($conn, $max_question_id_sql);
$max_question_id_row = mysqli_fetch_array($max_question_id_result);
$max_question_id = $max_question_id_row[0];

// Si la table "question" est vide, initialiser l'ID de la question à 1
if ($max_question_id === null) {
  $max_question_id = 1;
} else {
  $max_question_id++; // incrémenter l'ID de la question
}

// Insérer la question dans la table "question" pour récupérer l'ID de la question
$sql = "INSERT INTO question (id_question, Question) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "is", $max_question_id, $new_question);
mysqli_stmt_execute($stmt);

// Insérer la réponse dans la table "choix" avec l'ID de la question et l'ID de la réponse
$sql = "INSERT INTO choix (id, id_question, theme, reponse1, reponse2, reponse3, bonneReponse) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iisssss", $max_id, $max_question_id, $theme, $new_reponse1, $new_reponse2, $new_reponse3, $new_bonneReponse);
mysqli_stmt_execute($stmt);

// Insérer la question dans la table "question" pour récupérer l'ID de la question
$sql = "INSERT INTO question (Question) VALUES (?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $new_question);
mysqli_stmt_execute($stmt);

// Récupérer l'ID de la dernière question insérée
$question_id = mysqli_insert_id($conn);

// Insérer la réponse dans la table "choix" avec l'ID de la question et l'ID de la réponse
$sql = "INSERT INTO choix (id_question, theme, reponse1, reponse2, reponse3, bonneReponse) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "isssss", $question_id, $theme, $new_reponse1, $new_reponse2, $new_reponse3, $new_bonneReponse);
mysqli_stmt_execute($stmt);

// Rediriger vers la page des questions avec le thème sélectionné
header("Location: quizz.php?theme=$theme");
exit;