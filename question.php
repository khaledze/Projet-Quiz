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

    mysqli_set_charset($conn, 'utf8');

    if (isset($_GET['section'])) {
        $newSection = $_GET['section'];
        $query  = "SELECT choix ";
        $query .= "FROM category ";
        $query .= "WHERE id = {$newSection}";
        $sectionInfo = mysqli_query($conn, $query);
        $section = mysqli_fetch_assoc($sectionInfo);
        $output = $section["choix"];
        echo $output;
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
	?>

	<form method="POST" action="">
		<?php
		$i = 1; // compteur pour les questions
        while ($row = mysqli_fetch_assoc($result)) {
            $style = "display:none;";
            if ($i == 1) {
                $style = "";
            }
            echo "<div id='question_" . $row['id_question'] . "' class='question' style='" . $style . "'>";
            echo "<p>" . $row['Question'] . "</p>";
            echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse1'] . "'> " . $row['reponse1'] . "</label><br>";
            echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse2'] . "'> " . $row['reponse2'] . "</label><br>";
            echo "<label><input type='radio' name='reponse_" . $row['id_question'] . "' value='" . $row['reponse3'] . "'> " . $row['reponse3'] . "</label><br>";
            // Afficher le bouton "submit" uniquement pour la dernière question
        if ($i == mysqli_num_rows($result)) {
            echo "<input type='submit' name='submit' value='Valider'>";
            
        } else {
            echo "<button type='button' onclick='nextQuestion()'>Suivant</button>";
            
        }
        echo "</div>";
        $i++;
        $lastQuestion = $row['id_question'];
            
            
        }
        echo "<button onclick=\"location.href='Jeux.html'\">quitter</button>";

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
	</form>

	<script>
    var currentQuestion = 1;
    var numQuestions = <?php echo mysqli_num_rows($result); ?>;

    function nextQuestion() {
  // Vérifier que l'utilisateur a sélectionné une réponse
  var radios = document.getElementsByName("reponse_" + currentQuestion);
  var answerSelected = false;
  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
      answerSelected = true;
      break;
    }
  }
  if (!answerSelected) {
    alert("Veuillez sélectionner une réponse.");
    return;
  }
  // Passer à la question suivante
  var currentQuestionDiv = document.getElementById("question_" + currentQuestion);
  currentQuestionDiv.style.display = "none";
  currentQuestion++;

  if (currentQuestion <= numQuestions) {
    var nextQuestionDiv = document.getElementById("question_" + currentQuestion);
    nextQuestionDiv.style.display = "block";
  }
}
function nextQuestion() {
  // Vérifier que l'utilisateur a sélectionné une réponse
  var radios = document.getElementsByName("reponse_" + currentQuestion);
  var answerSelected = false;
  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
      answerSelected = true;
      break;
    }
  }
  if (!answerSelected) {
    alert("Veuillez sélectionner une réponse.");
    return;
  }
  // Passer à la question suivante
  var currentQuestionDiv = document.getElementById("question_" + currentQuestion);
  currentQuestionDiv.style.display = "none";
  currentQuestion++;

  if (currentQuestion <= numQuestions) {
    var nextQuestionDiv = document.getElementById("question_" + currentQuestion);
    nextQuestionDiv.style.display = "block";
  } else{
    var scoreContainer = document.getElementById("score-container");
    scoreContainer.innerHTML = "<p>Votre score est de : <span id='percent_score'>" + percentScore + "</span>%</p>";
    let recommencerBtn = document.getElementById("recommencer");
let quitterBtn = document.getElementById("quitter");
}
}


</script>
</body>
</html>

