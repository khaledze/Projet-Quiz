<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/Projet-Quiz/questions.css">
<link rel="stylesheet" href="/Projet-Quiz/lien.css">
	<title>Questions</title>
</head>
<body>
<nav class="sidebar close">
        <header>  
                    <span class="image">
                     
                   </span>
             <i class='bx bx-chevron-right toggle'></i>
         </header>
    <div class="menu-bar">
        <div class="menu">

            <li class="search-box">
                <i class='bx bx-search icon'></i>
                <input type="text" placeholder="Search..." id="searchBox">
            </li>


            <ul class="menu-links">
                <li class="nav-link">
                    <a href="contact.html">
                        <i class='bx bx-bar-chart-alt-2 icon' >
                            <img src="/Projet-Quiz/photo/contact.png" alt="contact" width="40px" height="35px">
                        </i>
                        <span class="text nav-text">Contact</span>
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="bottom-content">
        <li class="">
        <li class="">
                    <a onclick="goBack()">
                        <i class='bx bx-log-out icon' >
                            <img src="/Projet-Quiz/photo/back.png" alt="deco" width="35px" height="35px">
                        </i>
                        <span class="text nav-text" >Retour</span>
                    </a>
                </li>
    
                <li class="">
                    <a href="/Projet-Quiz/html/Acceuil2.php">
                        <i class='bx bx-log-out icon' >
                            <img src="/Projet-Quiz/photo/deco.png" alt="deco" width="35px" height="35px">
                        </i>
                        <span class="text nav-text" >Se déconnecter</span>
                    </a>
                </li>
            <li class="mode">
                <div class="sun-moon">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>
                <span class="mode-text text">Dark mode</span>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
            
        </div>
    </div>
</nav>
<script>
        
     const body = document.querySelector('body');
    const sidebar = body.querySelector('nav');
    const toggle = body.querySelector(".toggle");
    const searchBtn = body.querySelector(".search-box");
    const modeSwitch = body.querySelector(".toggle-switch");
    const modeText = body.querySelector(".mode-text");
    const images = document.querySelectorAll('.test img');
    const imageSwitch = document.querySelector('.toggle-switch-image');
    toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    });
    searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
    });
    modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
        images.forEach(function(img) {
        img.src = '/Projet-Quiz/photo/quiz2.png';
        });
    } else {
        modeText.innerText = "Dark mode";
        images.forEach(function(img) {
        img.src = '/Projet-Quiz/photo/icone.png';
        });
    }
    });
    imageSwitch.addEventListener('click', function() {
    images.forEach(function(img) {
        if (document.body.classList.contains('dark')) {
        img.src = '/Projet-Quiz/photo/quiz2.png';
        } else {
        img.src = '/Projet-Quiz/photo/icone.png';
        }
    });
    });
    function goBack() {
    window.history.back();
}
        
    </script>
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

  $minQuery = "SELECT MIN(q.id_question) AS min_id FROM question q INNER JOIN choix c ON q.id_question = c.id_question WHERE c.theme = '$theme'";
  $minResult = mysqli_query($conn, $minQuery);
  $minRow = mysqli_fetch_assoc($minResult);
  $minQuestionId = $minRow["min_id"];

  $maxQuery = "SELECT MAX(q.id_question) AS max_id FROM question q INNER JOIN choix c ON q.id_question = c.id_question WHERE c.theme = '$theme'";
  $maxResult = mysqli_query($conn, $maxQuery);
  $maxRow = mysqli_fetch_assoc($maxResult);
  $maxQuestionId = $maxRow["max_id"];

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
            echo "<input type='submit' class='quit' name='submit' value='Valider'>";
            
        } else {
          echo "<button type='button' class='next-btn' onclick='nextQuestion()'>Suivant</button>";

            
        }
        echo "</div>";
        $i++;
        $lastQuestion = $row['id_question'];
          
            
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
	</form>
	<script>
 
var currentQuestion = <?php echo $minQuestionId; ?>;
var numQuestions = <?php echo $maxQuestionId; ?>;

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

  var nextQuestionId = currentQuestion + 1;
  while (nextQuestionId <= numQuestions) {
    var nextQuestionDiv = document.getElementById("question_" + nextQuestionId);
    if (nextQuestionDiv) {
      nextQuestionDiv.style.display = "block";
      break;
    }
    nextQuestionId++;
  }

  currentQuestion = nextQuestionId;
}



</script>
</body>
</html>


