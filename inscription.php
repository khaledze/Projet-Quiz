<?php
$host ="localhost";
$user ="root";
$password ="";
$database ="quiz";
$connect = mysqli_connect($host,$user,$password,$database);

$pseudo = $_POST["Nom"];
$email = $_POST["email"];
$pwd = $_POST["pswd"];
$role = $_POST["role"];

if($connect){
    echo("Connected successfully<br>");

    $sql1 = "SELECT count(*) as nbUtilisateurs from utilisateur where pseudo = '" . $pseudo . "'";

    $result = mysqli_query($connect, $sql1);

    $data = mysqli_fetch_assoc($result);


    if ($data['nbUtilisateurs'] > 0) {
        echo "Ce pseudo est déjà utilisé<br>";
        exit;
    }
    else    {
        echo "Ce pseudo est disponible<br>";
        $sql = "INSERT INTO utilisateur(pseudo, email, password, role) VALUES ('" . $pseudo  . "', '" .$email . "', '" .$pwd . "', " .$role . ")";
        echo $sql . "<br>";

        if ($connect->query($sql) === TRUE) {
            echo "New record created successfully<br>";
          } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
          }
    }

}else{
    echo("Connection failed: " . mysqli_connect_error());

}
mysqli_close($connect);






?>