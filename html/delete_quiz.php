<?php

// Check if the theme parameter was provided in the URL
if (isset($_GET['theme'])) {
    // Get the theme parameter value
    $theme = $_GET['theme'];

    // Connect to your database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "quizz";

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the DELETE query
    $sql_titre = "DELETE FROM quizz WHERE titre='$theme'";
    $sql_question = "DELETE FROM question WHERE id_question IN (SELECT id_question FROM choix WHERE theme='$theme')";
    $sql_choix = "DELETE FROM choix WHERE theme='$theme'";

    // Execute the query
    if (mysqli_query($conn, $sql_titre) && mysqli_query($conn, $sql_question) && mysqli_query($conn, $sql_choix)) {
        header("Location: /Projet-Quiz/html/Jeux3.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du quiz: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect the user back to the page with the quiz list
    // header("Location: /Projet-Quiz/Jeux3.php");
    // exit();
}

