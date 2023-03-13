<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer la valeur du champ theme
        $theme = $_POST["theme"];
      
        // Se connecter à la base de données
        $host = "localhost"; 
        $user = "root";
        $password = ""; 
        $dbname = "db"; 
      
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
        header("Location: /Projet-Quiz/html/2.php");
        exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
    <label for="theme">theme :</label><br>
    <input type="text" id="theme" name="theme" required><br>
    <input type="submit" value="enregistrer">
</body>
</html>