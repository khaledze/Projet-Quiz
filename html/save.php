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

// Récupérer les données du formulaire
$questions = $_POST['question'];
$reponses1 = $_POST['reponse1'];
$reponses2 = $_POST['reponse2'];
$reponses3 = $_POST['reponse3'];
$bonnesReponses = $_POST['bonneReponse'];
$ids = $_POST['id'];
$theme = $_POST['theme'];

// Parcourir les données et exécuter la requête pour chaque enregistrement
for ($i = 0; $i < count($ids); $i++) {
    // Mise à jour de la table choix
    $stmt = mysqli_prepare($conn, "UPDATE choix SET id_question=?, reponse1=?, reponse2=?, reponse3=?, bonneReponse=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "issssi", $ids[$i], $reponses1[$i], $reponses2[$i], $reponses3[$i], $bonnesReponses[$i], $ids[$i]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    // Mise à jour de la table question
    $stmt = mysqli_prepare($conn, "UPDATE question SET Question=? WHERE id_question=?");
    mysqli_stmt_bind_param($stmt, "ss", $questions[$i], $ids[$i]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


// Rediriger vers la page des questions avec le thème sélectionné
header("Location: Jeux3.html");
exit;

?>

