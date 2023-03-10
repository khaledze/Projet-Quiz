<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Créer un Quiz</title>
	<link rel="stylesheet" href="/Projet-Quiz/creation.css">
</head>
<body>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Si la connexion est établie avec succès, on continue avec le reste du code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Insertion de la question dans la table 'question'
 

  $question = mysqli_real_escape_string($conn, $_POST['question']);
  $sql = "INSERT INTO question (question) VALUES ('$question')";



  if ($conn->query($sql) === TRUE) {
    $question_id = $conn->insert_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Insertion des réponses dans la table 'choix'
  $answer1 = $_POST['answer1'];
  $answer2 = $_POST['answer2'];
  $answer3 = $_POST['answer3'];
  $correct_answer_num = $_POST['correct_answer'];
$correct_answer = "";
switch ($correct_answer_num) {
  case "1":
    $correct_answer = mysqli_real_escape_string($conn, $_POST['answer1']);
    break;
  case "2":
    $correct_answer = mysqli_real_escape_string($conn, $_POST['answer2']);
    break;
  case "3":
    $correct_answer = mysqli_real_escape_string($conn, $_POST['answer3']);
    break;
  default:
    // handle invalid input
}


$sql = "INSERT INTO choix (reponse1, reponse2, reponse3, bonneReponse, id_question)
VALUES ('$answer1', '$answer2', '$answer3', '$correct_answer', LAST_INSERT_ID())";
if ($conn->query($sql) === TRUE) {
    // echo "Quiz créé avec succès";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>




<!-- formulaire pour créer un quiz -->
<form method="POST" action="" id="formulaire">
  <label for="theme">Thème:</label><br>
  <input type="text" id="theme" name="theme"><br><br>
  
  <div id="questions-container">
    <div class="question">
      <label for="question1">Question 1:</label><br>
      <input type="text" id="question1" name="question[]"><br>

      <label for="answer1_1">Réponse 1:</label><br>
      <input type="text" id="answer1_1" name="answer1[]"><br>

      <label for="answer2_1">Réponse 2:</label><br>
      <input type="text" id="answer2_1" name="answer2[]"><br>

      <label for="answer3_1">Réponse 3:</label><br>
      <input type="text" id="answer3_1" name="answer3[]"><br>

      <label for="correct_answer_1">Bonne réponse:</label><br>
      <select id="correct_answer_1" name="correct_answer[]">
        <option value="1">Réponse 1</option>
        <option value="2">Réponse 2</option>
        <option value="3">Réponse 3</option>
      </select><br><br>
    </div>
  </div>

  <input type="button" value="Ajouter une question" onclick="ajouterQuestion()"><br><br>

  <input type="submit" value="Créer le quiz">
</form>


</body>
<script src="/Projet-Quiz/creation.js"></script>
</html>
