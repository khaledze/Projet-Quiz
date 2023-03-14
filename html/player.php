
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
                                  <label for="new_password">Nouveau mot de passe :</label>
                                  <input type="password" name="new_password" id="new_password">
                                  <input type="submit" value="Modifier">
                                  </form>';
                            if (isset($_POST['new_password']) && $_POST['new_password'] != "") {
                                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                                $update_sql = "UPDATE player SET password=:new_password WHERE email=:email";
                                $update_stmt = $conn->prepare($update_sql);
                                $update_stmt->bindParam(':new_password', $new_password);
                                $update_stmt->bindParam(':email', $email);
                                if (!$update_stmt->execute()) {
                                    echo "Error executing SQL query: " . print_r($update_stmt->errorInfo(), true);
                                } else {
                                    echo "Mot de passe modifié avec succès !";
                                }
                            }
                        } else {
                            echo "Aucune information trouvée pour l'utilisateur avec l'email " . $email;
                        }
            
                        // afficher un bouton pour retourner à la page de jeu
                        echo "<a href='Jeux.html'><button>Retour au jeu</button></a>";
                    }
                    ?>
                </div>
            </div>
        </body>
</html>            




    
