<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Récupérer la valeur du champ theme
  $theme = $_POST["theme"];

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
</head>
<body>

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

</body>
</html>
