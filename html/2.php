<?php
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

// Récupérer le dernier titre de quiz ajouté
$sql_last_quizz = "SELECT titre FROM quizz ORDER BY id DESC LIMIT 1";
$result_last_quizz = mysqli_query($conn, $sql_last_quizz);

if ($result_last_quizz) {
  $row_last_quizz = mysqli_fetch_assoc($result_last_quizz);
  $last_quizz_title = $row_last_quizz['titre'];
} else {
  $last_quizz_title = '';
}

mysqli_close($conn);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Projet-Quiz/lien.css">
</head>
<body>
<div class="menu-bar">
            <div class="menu">
    
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
    
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
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
                    
                        <?php if (!empty($last_quizz_title)): ?>
                        <li class="nav-link">
                        <ul>
                            <li><?php echo $last_quizz_title; ?></li>
                        </ul>
                        </li>
                        <?php endif; ?>
                    
                </ul>
            </div>
    
            <div class="bottom-content">
                <li class="">
                    <a href="/Projet-Quiz/html/Acceuil2.php">
                        <i class='bx bx-log-out icon' >
                            <img src="/Projet-Quiz/photo/deco.png" alt="deco" width="35px" height="35px">
                        </i>
                        <span class="text nav-text" >Logout</span>
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
</body>
</html>