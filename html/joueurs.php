<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/Projet-Quiz/lien.css">
    <link rel="stylesheet" href="/Projet-Quiz/joueur.css">
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
                        <a href="joueurs.php">
                            <i class='bx bx-bell icon'>
                                <img src="/Projet-Quiz/photo/utl.png" alt="+" width="35px" height="35px">
                            </i>
                            <span class="text nav-text">Utilisateurs</span>
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

    <div class="list">
    <div class="code">
        <?php
            // Connexion à la base de données
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "quizz";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "connexion réussie";
            } catch(PDOException $e) {
                echo "<script>alert('connexion echoué !');</script>" . $e->getMessage();
            }

            // Récupération de tous les joueurs
            $sql = "SELECT * FROM player";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $joueurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des joueurs
            echo "<h1>Liste des joueurs :</h1>";
            echo "<table>";
            foreach($joueurs as $joueur) {
                echo "<tr>";
                echo "<td><strong>" . $joueur['pseudo'] . "</strong> (" . $joueur['email'] . ") - Rôle : " . $joueur['role'] . "</td>";
                echo "<td><form method='post' action='modifier.php'>";
                echo "<input type='hidden' name='pseudo' value='" . $joueur['pseudo'] . "'>";
                echo "<input type='hidden' name='email' value='" . $joueur['email'] . "'>";
                echo "<input type='hidden' name='role' value='" . $joueur['role'] . "'>";
                echo "<input type='hidden' name='password' value='" . $joueur['password'] . "'>";
                echo "<input type='image' src='/Projet-Quiz/photo/modifier.png' alt='Modifier' width='30' height='30'>";
                echo "</form></td>";
                echo "<td></td>";
                echo "<td><form method='post' action='supprimer.php'>";
                echo "<input type='hidden' name='pseudo' value='" . $joueur['pseudo'] . "'>";
                echo "<input type='image' src='/Projet-Quiz/photo/delete.png' alt='Supprimer' width='30' height='30'>";
                echo "</form></td>";

                echo "</tr>";
            }
            echo "</table>";
            echo "<button onclick=\"window.location.href='/Projet-Quiz/html/Jeux3.html'\" class=\"button\">Quitter</button>";

            // Fermeture de la connexion à la base de données
            $conn = null;
        ?>
    </div>
    </div>
 <script src="/Projet-Quiz/nvx.js"></script>
</body>
</html>


