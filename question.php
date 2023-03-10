<!DOCTYPE html>
<html>
<head>
	<title>Questions</title>
</head>
<body>
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

	// Récupérer le thème choisi
	if (isset($_GET['theme'])) {
		$theme = htmlspecialchars($_GET['theme']);
	} else {
		echo "Aucun thème sélectionné.";
		exit;
	}

	// Récupération des questions
	if ($theme != "") {
		$query = "SELECT q.id_question, q.Question, c.reponse1, c.reponse2, c.reponse3, c.bonneReponse 
			  FROM question q 
			  INNER JOIN choix c ON q.id_question = c.id_question 
			  WHERE c.theme = '$theme'";
	} else {
		$query = "SELECT q.id_question, q.Question, c.reponse1, c.reponse2, c.reponse3, c.bonneReponse 
			  FROM question q 
			  INNER JOIN choix c ON q.id_question = c.id_question";
	}
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die('Erreur de récupération des questions : ' . mysqli_error($conn));
	}

	// Affichage des questions et des réponses
	while ($row = mysqli_fetch_assoc($result)) {
	    echo "<p>" . $row['Question'] . "</p>";
	    echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse1'] . "'> " . $row['reponse1'] . "</label><br>";
	    echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse2'] . "'> " . $row['reponse2'] . "</label><br>";
	    echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse3'] . "'> " . $row['reponse3'] . "</label><br>";   
	}

// Vérification des réponses et calcul du score
if (isset($_POST['submit'])) {
    $score = 0;
    mysqli_data_seek($result, 0); // Retour au début du résultat
    while ($row = mysqli_fetch_assoc($result)) {
        if (isset($_POST['reponse_' . $row['id_question']])) {
            $user_answer = $_POST['reponse_' . $row['id_question']];
            $correct_answer = $row['bonneReponse'];
            if ($user_answer == $correct_answer) {
                $score++;
            }
        }
    }
    $percent_score = ($score / mysqli_num_rows($result)) * 100;
    echo "<p>Votre score est de : " . $percent_score . "%</p>";
}

?>

<form method="POST" action="">
	<br><input type='submit' name='submit' value='Valider'>
</form>
</body>
</html>



