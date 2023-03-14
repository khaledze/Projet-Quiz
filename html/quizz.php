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

    $sql = "SELECT c.*, q.Question FROM choix c JOIN question q ON c.id_question = q.id_question WHERE c.theme = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $theme);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    

    echo "<h1>modifier les questions</h1>";
    echo "<form method='post' action='save.php'>";
    while ($row = mysqli_fetch_assoc($result)) {
        // Afficher la question et les réponses
        echo "<label>Question:</label>";
        echo "<input type='text' name='question[]' value='" . htmlspecialchars(mysqli_real_escape_string($conn, $row['Question'])) . "'><br>";
        echo "<label>Reponse 1:</label>";
        echo "<input type='text' name='reponse1[]' value='" . htmlspecialchars($row['reponse1']) . "'><br>";
        echo "<label>Reponse 2:</label>";
        echo "<input type='text' name='reponse2[]' value='" . htmlspecialchars($row['reponse2']) . "'><br>";
        echo "<label>Reponse 3:</label>";
        echo "<input type='text' name='reponse3[]' value='" . htmlspecialchars($row['reponse3']) . "'><br>";
        echo "<label>Bonne réponse:</label>";
        echo "<input type='text' name='bonneReponse[]' value='" . htmlspecialchars($row['bonneReponse']) . "'><br>";
        echo "<input type='hidden' name='id[]' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<input type='hidden' name='theme' value='" . htmlspecialchars($theme) . "'>";
      
         // Ajouter un bouton de suppression
         echo "<a href='delete.php?id=" . htmlspecialchars($row['id_question']) . "&theme=" . htmlspecialchars($theme) . "'><img src='/Projet-Quiz/photo/delete.png' alt='Supprimer' width='20' height='20'></a>";

      
        echo "<hr>";
      }
    echo "<input type='submit' value='Enregistrer'>";
    echo "</form>";
    echo "<h2>Créer une nouvelle question</h2>";
    echo "<form method='post' action='nouvelle.php'>";
    echo "<label>Question:</label>";
    echo "<input type='text' name='new_question'><br>";
    echo "<label>Reponse 1:</label>";
    echo "<input type='text' name='new_reponse1'><br>";
    echo "<label>Reponse 2:</label>";
    echo "<input type='text' name='new_reponse2'><br>";
    echo "<label>Reponse 3:</label>";
    echo "<input type='text' name='new_reponse3'><br>";
    echo "<label>Bonne réponse:</label>";
    echo "<input type='text' name='new_bonneReponse'><br>";
    echo "<input type='hidden' name='theme' value='" . htmlspecialchars($theme) . "'>";
    echo "<input type='submit' value='Créer'>";
    echo "</form>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/Projet-Quiz/quizz.css">
    <link rel="stylesheet" href="/Projet-Quiz/lien.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="sidebar close">
             <header>  
                        <div class="titre">
                         Quizzeo
                        </div>
                 <i class='bx bx-chevron-right toggle'></i>
             </header>
    
        <div class="menu-bar">
            <div class="menu">
    
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
    </section>
    <script>
        const titre = document.querySelector('.titre');
            const body = document.querySelector('body');
        const sidebar = body.querySelector('nav');
        const toggle = body.querySelector(".toggle");
        const modeSwitch = body.querySelector(".toggle-switch");
        const modeText = body.querySelector(".mode-text");
        const images = document.querySelectorAll('.test img');
        const imageSwitch = document.querySelector('.toggle-switch-image');

        toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        });
        titre.addEventListener('click', () => {
        sidebar.classList.toggle('close');
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
   
</body>
</html>

