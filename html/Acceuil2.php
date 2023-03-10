<?php
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

    if(isset($_POST['envoyer'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $pswd = htmlspecialchars($_POST['pswd']);
		$role = htmlspecialchars($_POST['role']);

        $sql = "INSERT INTO player (pseudo, email, password, role) VALUES (:pseudo, :email, :pswd, :role)";
		$stmt = $conn->prepare($sql);
			
		$stmt->bindParam(':pseudo', $pseudo);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':pswd', $pswd);
		$stmt->bindParam(':role', $role);
		$stmt->execute();
		if($role == "utilisateur") {
			header("Location: /Projet-Quiz/html/Jeux.html");
		} else {
			header("Location: /Projet-Quiz/html/Jeux2.html");
		}
    }

	if(isset($_POST['connecter'])){
		$email = htmlspecialchars($_POST['email']);
		$pswd = htmlspecialchars($_POST['pswd']);
	
		$sql = "SELECT role FROM player WHERE email=:email AND password=:pswd";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':pswd', $pswd);
		$stmt->execute();
		$result = $stmt->fetch();
	
		if($result) {
			// si les informations de connexion sont correctes, on redirige vers la page correspondante
			if ($result['role'] == 'utilisateur') {
				header("Location: /Projet-Quiz/html/Jeux.html");
				exit();
			} elseif ($result['role'] == 'quizzeur') {
				header("Location: /Projet-Quiz/html/Jeux2.html");
				exit();
			}
		} else {
			// si les informations de connexion sont incorrectes, afficher un message d'erreur
			echo "<script>alert('erreur de connexion !');</script>";
		}
	}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<title>formulaire</title>
	<link rel="stylesheet" href="/Projet-Quiz/animation.css" />
    <link rel="stylesheet" href="/Projet-Quiz/Acceuil2.css" />
<body>
	
	<div class="container" id="container">
		<div class="form-container sign-up-container">		
			<form action="" method="POST">
				<h1>Creer un compte</h1>
					
				<input type="text" placeholder="Pseudo" name="pseudo">
				<input type="email" placeholder="Email" name="email">
				<input type="password" placeholder="Mot de passe" name="pswd">
				<label for="userType">Choisir le type de compte:</label>
				<select id="userType" name="role">
				  <option value="">--Choisir--</option>
				  <option value="utilisateur">Utilisateur</option>
				  <option value="quizzeur">Quizzeur</option>
				</select>
				<button id="button2" type="submit" name="envoyer">Créer un compte</button> 				
			</form>
		</div>
		<div class="form-container login-container">
			<form action="" method="POST">
				<h1>Se connecter</h1>	
				<input type="email" placeholder="Email" name="email">
				<input type="password" placeholder="Mot de passe" name="pswd">
				<button id="button1" type="submit" name="connecter">Se connecter</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
						<img src="/Projet-Quiz/photo/logo5.png" alt="Logo" height="150px">
						<button class="ghost" id="login">Se connecter</button>
				</div>
					<div class="overlay-panel overlay-right">
						<img src="/Projet-Quiz/photo/logo5.png" alt="Logo" height="150px">
						<button class="ghost" id="signUp">Creer un compte</button>
					</div>
			</div>
		</div>
	</div>
	<div class="test">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
		<img src="/Projet-Quiz/photo/icone.png" alt="">
	</div>
	

	<script src="/Projet-Quiz/Acceuil2.js"></script>
</body>

</html>