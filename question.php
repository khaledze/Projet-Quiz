<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        class capitale {
            public $question;
            public $options;
            public $answer;
                
            public function __construct($question,$options,$answer) {
                $this->question = $question;
                $this->options = $options;
                $this->answer = $answer;
            }
        }
        $question = array(
            new capitale(
                "Quelle est la capitale administrative du Maroc ?",
                array("Casablanca", "Rabat", "Essaouira", "Marrakech"),
                "Rabat"),
            new capitale(
                "Quelle est la capitale de l’Italie ?",
                array("Rome", "Milan", "Naples", "Florence"),
                "Rome"),
            new capitale(
                "Quelle est la capitale de Cuba ?",
                array("Saint-Domingue", "La Havane", "Kingston", "Santiago de Cuba"),
                "La Havane"),
            new capitale(
                "Quelle est la capitale du Nigeria ?",
                array("Abuja", "Kano", "Accra", "Libreville"),
                "Abuja"),
            new capitale(
                "Quelle est la capitale du Yémen ?",
                array("Mascate", "Abou Dabi", "Sanaa", "Sakaka"),
                "Sanaa"),
            new capitale(
                "Quelle est la capitale d’Haïti ?",
                array("Las Terrenas", "Port-au-Prince", "Nassau", "Veracruz"),
                "Port-au-Prince"),
            new capitale(
                "Quelle est la capitale de l’Équateur ?",
                array("Medellin", "San José", "La Paz", "Quito"),
                "Quito"),
            new capitale(
                "Quelle est la capitale de l’Ukraine ?",
                array("Mariaoupol", "Odessa", "Varsovie", "Kiev"),
                "Kiev"),
            new capitale(
                "Quelle est la capitale de l’Irlande ?",
                array("Cork", "Belfast", "Dublin", "Glasgow"),
                "Dublin"),
            new capitale(
                "Quelle est la capitale du Ghana ?",
                array("Tombouctou", "Accra", "Bangui", "Djibouti"),
                "Accra"),
        );  
                $questionCount = count($question);
                $playerScore = 0;
                for ($i = 0; $i < $questionCount; $i++) {
                    $currentQuestion = $question[$i];
                    $userAnswer = $_POST["question ".$i];
                    if ($userAnswer == $currentQuestion["answer"]) {
                        $playerScore++;
                    }
                }
                echo "votre score est de $playerScore";
    ?>

</body>
</html>


