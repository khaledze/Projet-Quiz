<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil joueur</title>
</head>
<body>
    <h1>Profil joueur</h1>
    
    <?php
        session_start();
        $pseudo = $_POST['pseudo'];
        echo $pseudo;

        // Connexion à la base de données
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quizz";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Récupération des informations de l'utilisateur depuis la table player
        $sql = "SELECT * FROM player WHERE pseudo = '$pseudo'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Affichage des informations de l'utilisateur
            $row = mysqli_fetch_assoc($result);
            echo "<p>Pseudo : " . $row['pseudo'] . "</p>";
            echo "<p>Email : " . $row['email'] . "</p>";
            echo "<p>Password : " . $row['password'] . "</p>";
        } else {
            echo "Aucun joueur trouvé avec ce pseudo.";
        }

        mysqli_close($conn);
    ?>
    
</body>
</html>