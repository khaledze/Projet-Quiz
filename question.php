<?php

session_start(); // Démarrage de la session

$host = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    echo("La connexion a échoué: " . mysqli_connect_error());
} else {
    if (!isset($_SESSION["question_index"])) {
        $_SESSION["question_index"] = 0; // Initialisation de l'indice de la question
    }

    // Récupération des questions et de leurs réponses associées depuis la base de données
    $questions_query = "SELECT * FROM question LIMIT " . $_SESSION["question_index"] . ", 1";
    $questions_result = mysqli_query($conn, $questions_query);

    // Affichage de la question courante avec les réponses associées
    while ($row = mysqli_fetch_assoc($questions_result)) {
        echo "<p>" . $row["Question"] . "</p>";

        // Récupération des réponses associées à la question courante depuis la base de données
        $reponses_query = "SELECT * FROM choix WHERE id_question = " . $row["id_question"];
        $reponses_result = mysqli_query($conn, $reponses_query);

        // Affichage des réponses sous forme de QCM
        echo "<form>";
        while ($reponse = mysqli_fetch_assoc($reponses_result)) {
            echo "<div>";
            echo "<input type='radio' id='reponse-" . $reponse["id"] . "' name='reponse-" . $row["id_question"] . "' value='" . $reponse["id"] . "'>";
            echo "<label for='reponse-" . $reponse["id"] . "'>" . $reponse["reponse1"] . "</label>";
            echo "<input type='radio' id='reponse-" . $reponse["id"] . "' name='reponse-" . $row["id_question"] . "' value='" . $reponse["id"] . "'>";
            echo "<label for='reponse-" . $reponse["id"] . "'>" . $reponse["reponse2"] . "</label>";
            echo "<input type='radio' id='reponse-" . $reponse["id"] . "' name='reponse-" . $row["id_question"] . "' value='" . $reponse["id"] . "'>";
            echo "<label for='reponse-" . $reponse["id"] . "'>" . $reponse["reponse3"] . "</label>";
            echo "</div>";
        }
        echo "</form>";

        // Ajout d'un bouton pour passer à la question suivante
        echo "<button onclick='this.parentElement.nextElementSibling.classList.remove(\"hidden\")'>Question suivante</button>";

    }

    mysqli_close($conn);
}
?>








