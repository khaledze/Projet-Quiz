<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Mon diaporama</title>
  <link rel="stylesheet" href="/Projet-Quiz/quizzz.css">
</head>
<body>

<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "data";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("Connexion échouée : " . mysqli_connect_error());
}

// Requête pour récupérer les questions
$sql = "SELECT question, reponse FROM questions";
$result = mysqli_query($conn, $sql);
?>

  <div class="container">

    <div class="slider">
      <?php while ($row = mysqli_fetch_assoc($result)) ?>
        <div class="slide">
          <h2><?php echo $row['question']; ?></h2>
          <p><?php echo $row['reponse']; ?></p>
        </div>
    </div>

    <div class="cont-btn">
      <div class="btn-nav left">←</div>
      <div class="btn-nav right">→</div>
    </div>

  </div>
  <script src="/Project-Quiz/slider.js"></script>
</body>
</html>
