
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/Projet-Quiz/lien.css">
    <link rel="stylesheet" href="/Projet-Quiz/joueur.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>player</title>
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
    
    
    <div class="list">
        <div class="code">
            <h1>information sur le joueur</h1>
            <?php
session_start();

// la connexion à la base de données
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

// récupérer l'email du joueur à partir de la variable de session
$email = $_SESSION['email'];

// exécuter une requête SQL SELECT pour récupérer les informations du joueur connecté
$sql = "SELECT pseudo, email, password FROM player WHERE email=:email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
if (!$stmt->execute()) {
    echo "Errorexécuting SQL query: " . print_r($stmt->errorInfo(), true);
} else {
    $result = $stmt->fetch();
    // vérifier si le résultat est non vide avant d'afficher les informations
    if ($result) {
        echo "Pseudo : " . $result['pseudo'] . "<br>";
        echo "Email : " . $email . "<br>";
        echo "Password : " . str_repeat("*", strlen($result['password'])) . "<br>";
        echo '<form method="POST">
              <label for="old_password">Ancien mot de passe :</label>
              <input type="password" name="old_password" id="old_password"><br>
              <label for="new_password">Nouveau mot de passe :</label>
              <input type="password" name="new_password" id="new_password"><br>
              <input type="submit" value="Modifier">
              </form>';
        if (isset($_POST['old_password']) && isset($_POST['new_password']) &&
            $_POST['old_password'] != "" && $_POST['new_password'] != "") {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            if ($old_password != $result['password']) {
                echo "Ancien mot de passe incorrect !";
            } else {
                $update_sql = "UPDATE player SET password=:new_password WHERE email=:email";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bindParam(':new_password', $new_password);
                $update_stmt->bindParam(':email', $email);
                if (!$update_stmt->execute()) {
                    echo "Error executing SQL query: " . print_r($update_stmt->errorInfo(), true);
                } else {
                    echo "Mot de passe modifié avec succès !";
                    header("Location: player.php");
                }
            }
        }
    }
}
?>

 </div>
 </div>
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
