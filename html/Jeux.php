<?php
    // Se connecter à la base de données
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $dbname = "quizz"; 

    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Vérifier la connexion
    if (!$conn) {
      die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Définir l'encodage des caractères à UTF-8
    mysqli_set_charset($conn, 'utf8');

    // Récupérer les titres des quiz avec un ID supérieur à 15
    $sql_quizz = "SELECT titre FROM quizz WHERE id > 149";
    $result_quizz = mysqli_query($conn, $sql_quizz);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/Projet-Quiz/Jeux.css">
    <link rel="stylesheet" href="/Projet-Quiz/lien.css">
    <link rel="stylesheet" href="/Projet-Quiz/animation2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux</title>
   <div class="header">
        <img src="/Projet-Quiz/photo/logo2.jpg" alt="Logo" height="100px">
        <div id="btn">
            <button type="button" class="deco" onclick="window.location.href = '/Projet-Quiz/html/Acceuil2.php';">
                Se déconnecter
              </button>
        </div>  
    </div>
</head>
<body>
    <div class="container">
        <nav class="sidebar close">
            <header>  
                        <div class="titre">
                         Quizzeo
                        </div>
                 <i class='bx bx-chevron-right toggle'></i>
             </header>
    
        <div class="menu-bar">
            <div class="menu">
    
            <li class="nav-link">
                        <a href="player.php">
                            <i class='bx bx-bell icon'>
                                <img src="/Projet-Quiz/photo/utl.png" alt="+" width="35px" height="35px">
                            </i>
                            <span class="text nav-text">mon compte</span>
                        </a>
                    </li>
    
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="contact.html">
                            <i class='bx bx-bar-chart-alt-2 icon' >
                                <img src="/Projet-Quiz/photo/contact.png" alt="contact" width="40px" height="35px">
                            </i>
                            <span class="text nav-text">Contact</span>
                        </a>
                    </li>
                    <?php 
                        if ($result_quizz && mysqli_num_rows($result_quizz) > 0) {
                            while ($row_quizz = mysqli_fetch_assoc($result_quizz)) {
                                echo ('<li class="nav-link">'.
                                    '<a href="question.php?theme='.$row_quizz['titre']  .'"' .
                                    '<span class="text nav-text">'. $row_quizz['titre'] .'</span>'.
                                    '</a>' .
                                    '</li>');
                            }
                        } else {
                            // echo 'Aucun titre de quiz trouvé.';
                        }
                        ?>
    
                    
                </ul>
            </div>
    
            <div class="bottom-content">
                <li class="">
                    <a onclick="goBack()">
                        <i class='bx bx-log-out icon' >
                            <img src="/Projet-Quiz/photo/back.png" alt="deco" width="35px" height="35px">
                        </i>
                        <span class="text nav-text" >Retour</span>
                    </a>
                </li>
    
                <li class="">
                    <a href="/Projet-Quiz/html/Acceuil2.php">
                        <i class='bx bx-log-out icon' >
                            <img src="/Projet-Quiz/photo/deco.png" alt="deco" width="35px" height="35px">
                        </i>
                        <span class="text nav-text" >Se déconnecter</span>
                    </a>
                </li>
    
                <li class="mode">
                    <span class="mode-text text">Dark mode</span>
    
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>
    
    </nav>
    
    <section class="home">
        <div class="text"></div>
    </section>
    <script>
        const titre = document.querySelector('.titre');
            const body = document.querySelector('body');
        const sidebar = body.querySelector('nav');
        const toggle = body.querySelector(".toggle");
        const modeSwitch = body.querySelector(".toggle-switch");
        const modeText = body.querySelector(".mode-text");
        const images = document.querySelectorAll('.test img');
        const imageSwitch = document.querySelector('.toggle-switch-image');

        toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        });
        titre.addEventListener('click', () => {
        sidebar.classList.toggle('close');
        });

        modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");
        
        if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
        images.forEach(function(img) {
        img.src = '/Projet-Quiz/photo/quiz2.png';
        });
        } else {
        modeText.innerText = "Dark mode";
        images.forEach(function(img) {
        img.src = '/Projet-Quiz/photo/icone.png';
        });
        }
        });

        imageSwitch.addEventListener('click', function() {
        images.forEach(function(img) {
        if (document.body.classList.contains('dark')) {
        img.src = '/Projet-Quiz/photo/quiz2.png';
        } else {
        img.src = '/Projet-Quiz/photo/icone.png';
        }
        });
        });

        function goBack() {
        window.history.back();
        }
        </script>
    <div class="text">
        <h1>Testez vos competances </h1>

    </div>
        <div class="cards">
            <div>
                <div class="card" >
                    <div class="img"></div>
                    <div class="textBox">
                        <div class="textContent">
                            <p class="h1"><a href="question.php?theme=art" style="color: white; text-decoration: none;">Arts</a></p>
                        </div>
                        <p class="p">Quiz Arts</p>
                    </div>
                </div>
            </div>


            <div>
                <div class="card" >
                    <div class="img2"></div>
                    <div class="textBox2">
                        <div class="textContent2">
                            <p class="h1"><a href="question.php?theme=chanson" style="color: white; text-decoration: none;">Chanson</a></p>
                        </div>
                        <p class="p2">Quiz Chanson</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img3"></div>
                    <div class="textBox3">
                        <div class="textContent3">
                            <p class="h1"><a href="question.php?theme=cinema" style="color: white; text-decoration: none;">Cinema</a></p>
                        </div>
                        <p class="p3">Quiz Cinema</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img4"></div>
                    <div class="textBox4">
                        <div class="textContent4">
                            <p class="h1"><a href="question.php?theme=economie" style="color: white; text-decoration: none;">Economie</a></p>
                        </div>
                        <p class="p4">Quiz Economie</p>
                    </div>
                </div>
            </div>


            <div>
                <div class="card" >
                    <div class="img5"></div>
                    <div class="textBox5">
                        <div class="textContent5">
                            <p class="h1"><a href="question.php?theme=faune" style="color: white; text-decoration: none;">Faune</a></p>
                        </div>
                        <p class="p5">Quiz Faune</p>
                    </div>
                </div>
            </div>


            <div>
                <div class="card" >
                    <div class="img6"></div>
                    <div class="textBox6">
                        <div class="textContent6" >
                            <p class="h1"><a href="question.php?theme=flore" style="color: white; text-decoration: none;">Flore</a></p>
                        </div>
                        <p class="p6">Quiz Flore</p>
                    </div>
                </div>
            </div>
        

            <div>
                <div class="card" >
                    <div class="img7"></div>
                    <div class="textBox7">
                        <div class="textContent7" >
                            <p class="h1"><a href="question.php?theme=gastro" style="color: white; text-decoration: none;">Gastro</a></p>

                        </div>
                        <p class="p7">Quiz Gastro</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img8"></div>
                    <div class="textBox8">
                        <div class="textContent8" >
                            <p class="h1"><a href="question.php?theme=geographie" style="color: white; text-decoration: none;">Geographie</a></p>
                        </div>
                        <p class="p8">Quiz Geographie</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="img9"></div>
                    <div class="textBox9">
                        <div class="textContent9" >
                            <p class="h1"><a href="question.php?theme=histoire" style="color: white; text-decoration: none;">Histoire</a></p>
                        </div>
                        <p class="p9">Quiz Histoire</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img10"></div>
                    <div class="textBox10">
                        <div class="textContent10">
                            <p class="h1"><a href="question.php?theme=institution" style="color: white; text-decoration: none;">Institutions</a></p>
                        </div>
                        <p class="p10">Quiz Institutions</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="img11"></div>
                    <div class="textBox11">
                        <div class="textContent11" >
                            <p class="h1"><a href="question.php?theme=langue" style="color: white; text-decoration: none;">Langue</a></p>
                        </div>
                        <p class="p11">Quiz Langue</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img12"></div>
                    <div class="textBox12">
                        <div class="textContent12" >
                            <p class="h1"><a href="question.php?theme=litterature" style="color: white; text-decoration: none;">Litterature</a></p>
                        </div>
                        <p class="p12">Quiz Litterature</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img13"></div>
                    <div class="textBox13">
                        <div class="textContent13" >
                            <p class="h1"><a href="question.php?theme=mode" style="color: white; text-decoration: none;">Mode</a></p>
                        </div>
                        <p class="p13">Quiz Mode</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" >
                    <div class="img14"></div>
                    <div class="textBox14">
                        <div class="textContent14" >
                            <p class="h1"><a href="question.php?theme=quotidien" style="color: white; text-decoration: none;">Quotidien</a></p>
                        </div>
                        <p class="p14">Quiz Quotidien</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="img15"></div>
                    <div class="textBox15">
                        <div class="textContent15" >
                            <p class="h1"><a href="question.php?theme=sport" style="color: white; text-decoration: none;">Sports</a></p>
                        </div>
                        <p class="p15">Quiz Sports</p>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <main>   
        <div class="white">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
            <img src="/Projet-Quiz/photo/icone.png" alt="">
        </div>
        <div class="test-dark">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
            <img src="/Projet-Quiz/photo/quiz2.png" alt="">
        </div>
    </main>
      <script src="/Projet-Quiz/nvx.js"></script>
      
</body>
</html>