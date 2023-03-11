<!DOCTYPE html>
<html>
<head>
	<title>Création de quiz</title>
  <link rel="stylesheet" href="/Projet-Quiz/creation.css">
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Récupérer les valeurs du formulaire
  $question = $_POST['question'];
  $reponse1 = $_POST['reponse1'];
  $reponse2 = $_POST['reponse2'];
  $reponse3 = $_POST['reponse3'];
  

  if ($_POST['choix1'] == 'reponse1') {
	$bonneReponse = $reponse1;
  } elseif ($_POST['choix1'] == 'reponse2') {
	$bonneReponse = $reponse2;
  } elseif ($_POST['choix1'] == 'reponse3') {
	$bonneReponse = $reponse3;
  }

  // Se connecter à la base de données
  $host = "localhost"; 
  $user = "root";
  $password = ""; 
  $dbname = "data"; 

  $conn = mysqli_connect($host, $user, $password, $dbname);

  // Vérifier la connexion
  if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
  }

  // Insérer la question dans la table question
  $question = mysqli_real_escape_string($conn, $question);
  $sql_question = "INSERT INTO question (question) VALUES ('$question')";

  if (mysqli_query($conn, $sql_question)) {
    // echo "La question a été enregistrée avec succès.";
  } else {
    echo "Erreur : " . $sql_question . "<br>" . mysqli_error($conn);
  }

  // Récupérer l'ID de la question insérée
  $question_id = mysqli_insert_id($conn);

  // Insérer les réponses dans la table choix
  $sql_choix = "INSERT INTO choix (reponse1, bonneReponse, reponse2, reponse3, id_question) 
              VALUES ('$reponse1', '$bonneReponse', '$reponse2', '$reponse3', '$question_id')";

  if (mysqli_query($conn, $sql_choix)) {
    // echo "Les réponses ont été enregistrées avec succès.";
  } else {
    echo "Erreur : " . $sql_choix . "<br>" . mysqli_error($conn);
  }

  // Fermer la connexion à la base de données
  mysqli_close($conn);
}
?>

	<form method="post" action="">
		<label for="question">Question 1 :</label><br>
		<input type="text" id="question" name="question" required><br>

		<label for="reponse1">Réponse 1 :</label><br>
		<input type="text" id="reponse1" name="reponse1" required><br>

		<label for="reponse2">Réponse 2 :</label><br>
		<input type="text" id="reponse2" name="reponse2" required><br>

		<label for="reponse3">Réponse 3 :</label><br>
		<input type="text" id="reponse3" name="reponse3" required><br>

		<label for="choix1">Choix de la bonne réponse :</label><br>
		<select id="choix1" name="choix1" required>
			<option value="">--Choisir la bonne réponse--</option>
			<option value="reponse1">Réponse 1</option>
			<option value="reponse2">Réponse 2</option>
			<option value="reponse3">Réponse 3</option>
		</select><br><br>

		<input type="submit" value="Enregistrer">
	</form>
</body>
</html>
