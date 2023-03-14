<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Récupérer la valeur du champ theme
  $theme = $_POST["theme"];

  // Se connecter à la base de données
  $host = "localhost"; 
  $user = "root";
  $password = ""; 
  $dbname = "quizz"; 

  $conn = mysqli_connect($host, $user, $password, $dbname);

  // Vérifier la connexion
  if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
  }

  // Définir l'encodage des caractères à UTF-8
  mysqli_set_charset($conn, 'utf8');

  // Insérer le titre dans la table quizz
  $theme = mysqli_real_escape_string($conn, $theme);
  $sql_quizz = "INSERT INTO quizz (titre) VALUES ('$theme')";

  if (mysqli_query($conn, $sql_quizz)) {
    // echo "Le quizz a été créé avec succès.";
  } else {
    echo "Erreur : " . $sql_quizz . "<br>" . mysqli_error($conn);
  }

  // Récupérer l'ID du quizz inséré
  $quizz_id = mysqli_insert_id($conn);


  // Récupérer les valeurs du formulaire pour chaque question
  for ($i = 1; $i <= 10; $i++) {
    $question = $_POST["question".$i];
    $reponse1 = $_POST["reponse1_".$i];
    $reponse2 = $_POST["reponse2_".$i];
    $reponse3 = $_POST["reponse3_".$i];
    $thema = $_POST["theme"];
    
    // Récupérer la bonne réponse
    if ($_POST["choix_".$i] == "reponse1_".$i) {
      $bonneReponse = $reponse1;
    } elseif ($_POST["choix_".$i] == "reponse2_".$i) {
      $bonneReponse = $reponse2;
    } elseif ($_POST["choix_".$i] == "reponse3_".$i) {
      $bonneReponse = $reponse3;
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
    $reponse1 = mysqli_real_escape_string($conn, $reponse1);
    $reponse2 = mysqli_real_escape_string($conn, $reponse2);
    $reponse3 = mysqli_real_escape_string($conn, $reponse3);
    $bonneReponse = mysqli_real_escape_string($conn, $bonneReponse);
    $thema = mysqli_real_escape_string($conn, $thema);
    $sql_choix = "INSERT INTO choix (reponse1, bonneReponse, reponse2, reponse3, id_question,theme) 
                VALUES ('$reponse1', '$bonneReponse', '$reponse2', '$reponse3', '$question_id','$thema')";

    if (mysqli_query($conn, $sql_choix)) {
      // echo "Les réponses ont été enregistrées avec succès.";
    } else {
      echo "Erreur : " . $sql_choix . "<br>" . mysqli_error($conn);
    }


    
  }
  // Récupérer l'ID du quizz inséré
  $quizz_id = mysqli_insert_id($conn);
  header("Location: /Projet-Quiz/html/Jeux2.php");
  exit;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Création de quiz</title>
  <link rel="stylesheet" href="/Projet-Quiz/creation.css">
  <link rel="stylesheet" href="/Projet-Quiz/lien.css">
</head>
<body>
  <div class="container">
    <nav class="sidebar close">
            <header>  
                 <span class="image"></span>
                 <i class='bx bx-chevron-right toggle'></i>
             </header>
        <div class="menu-bar">
            <div class="menu">
            <li class="search-box">
                <i class='bx bx-search icon'></i>
            </li>
            <li class="nav-link">
                 <a href="player.php">
                      <i class='bx bx-bell icon'>
                        <img src="/Projet-Quiz/photo/utl.png" alt="+" width="35px" height="35px">
                           </i>
                        <span class="text nav-text">mon compte</span>
                  </a>
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
                    <li class="nav-link">
                        <a href="/Projet-Quiz/html/creation.php">
                            <i class='bx bx-bell icon'>
                                <img src="/Projet-Quiz/photo/+.png" alt="+" width="35px" height="35px">
                            </i>
                            <span class="text nav-text">Créer votre Quiz</span>
                        </a>
                    </li>
                </ul>
   </div>
    
    <div class="bottom-content">
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
    
    
        <!-- <div class="home">Quizzeo</div> -->
    
    
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

 <div class="bruh">
    <form method="post" action="">
        <label for="theme">theme :</label><br>
        <input type="text" id="theme" name="theme" required><br>
      <?php for ($i = 1; $i <= 10; $i++) { ?>
        <h2>Question <?php echo $i; ?></h2>
        <label for="question_<?php echo $i; ?>">Question :</label><br>
        <input type="text" id="question_<?php echo $i; ?>" name="question<?php echo $i; ?>" required><br>

        <label for="reponse1_<?php echo $i; ?>">Réponse 1 :</label><br>
        <input type="text" id="reponse1_<?php echo $i; ?>" name="reponse1_<?php echo $i; ?>" required>
        <input type="radio" id="choix_<?php echo $i; ?>_1" name="choix_<?php echo $i; ?>" value="reponse1_<?php echo $i; ?>" required>
        <label for="choix_<?php echo $i; ?>_1">Bonne réponse</label><br>

        <label for="reponse2_<?php echo $i; ?>">Réponse 2 :</label><br>
        <input type="text" id="reponse2_<?php echo $i; ?>" name="reponse2_<?php echo $i; ?>" required>
        <input type="radio" id="choix_<?php echo $i; ?>_2" name="choix_<?php echo $i; ?>" value="reponse2_<?php echo $i; ?>" required>
        <label for="choix_<?php echo $i; ?>_2">Bonne réponse</label><br>

        <label for="reponse3_<?php echo $i; ?>">Réponse 3 :</label><br>
        <input type="text" id="reponse3_<?php echo $i; ?>" name="reponse3_<?php echo $i; ?>" required>
        <input type="radio" id="choix_<?php echo $i; ?>_3" name="choix_<?php echo $i; ?>" value="reponse3_<?php echo $i; ?>" required>
        <label for="choix_<?php echo $i; ?>_3">Bonne réponse</label><br>
        <?php } ?>
        <br>
        <input type="submit" value="Créer le quiz">
    </form>
  </div>
</div>
</body>
</html>
