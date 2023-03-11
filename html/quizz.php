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
        echo "<form method='post' action='delete.php'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id_question']) . "'>";
        echo "<input type='hidden' name='theme' value='" . htmlspecialchars($theme) . "'>";
        echo "<input type='submit' value='Supprimer cette question'>";
        echo "</form>";
      
        echo "<hr>";
      }
    echo "<input type='submit' value='Enregistrer les modifications'>";
    echo "</form>";
?>

