<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
    exit();
}

// Vérification de la soumission du formulaire de modification
if(isset($_POST['modifier'])) {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    
    // Mise à jour des informations du joueur dans la base de données
    $sql = "UPDATE player SET pseudo=:pseudo, email=:email, role=:role, password=:password WHERE pseudo=:old_pseudo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':old_pseudo', $_POST['old_pseudo']);
    $stmt->execute();
    
    // Redirection vers la page de liste des joueurs après la modification
    header('Location: joueurs.php');
    exit();
}

// Récupération des informations du joueur à modifier
$pseudo = $_POST['pseudo'];
$sql = "SELECT * FROM player WHERE pseudo=:pseudo";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':pseudo', $pseudo);
$stmt->execute();
$joueur = $stmt->fetch(PDO::FETCH_ASSOC);

// Fermeture de la connexion à la base de données
$conn = null;
?>
<html>
<head>
    <title>Modifier un joueur</title>
</head>
<body>
    <h1>Modifier un joueur</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="old_pseudo" value="<?php echo $joueur['pseudo']; ?>">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" value="<?php echo $joueur['pseudo']; ?>"><br>
        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo $joueur['email']; ?>"><br>
        <label for="role">Rôle :</label>
        <select name="role">
        <option value="utilisateur" <?php if($joueur['role'] == 'utilisateur') echo 'selected'; ?>>Utilisateur</option>
        <option value="quizzeur" <?php if($joueur['role'] == 'quizzeur') echo 'selected'; ?>>Quizzeur</option>
        </select><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" value="<?php echo $joueur['password']; ?>"><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</body>
</html>



