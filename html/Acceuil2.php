<?php
    // la connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "data";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connexion réussie";
    } catch(PDOException $e) {
        echo "connexion échouée : " . $e->getMessage();
    }

    if(isset($_POST['envoyer'])){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $pswd = htmlspecialchars($_POST['pswd']);

        $sql = "INSERT INTO player (pseudo, email, password) VALUES (:pseudo, :email, :pswd)";
		$stmt = $conn->prepare($sql);
			
		$stmt->bindParam(':pseudo', $pseudo);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':pswd', $pswd);
		$stmt->execute();

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
				<input type="email" placeholder="Email">
				<input type="password" placeholder="Mot de passe">
				<li id="button1">Se connecter</li>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
						<img src="/Projet-Quiz/photo/logo2.jpg" alt="Logo" height="100px">
						<button class="ghost" id="login">Se connecter</button>
				</div>
					<div class="overlay-panel overlay-right">
						<img src="/Projet-Quiz/photo/logo2.jpg" alt="Logo" height="100px">
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