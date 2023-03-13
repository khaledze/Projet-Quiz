// document.getElementById("quit").addEventListener("click", function()
// { 
//      window.location.href = "/Projet-Quiz/html/Jeux.html";
// });

// document.getElementById("userType").addEventListener("change", function() {
//      var selectedValue = this.value;
//      if (selectedValue === "utilisateur") {
//        window.location.href = "jouer.html";
//      } else if (selectedValue === "quizzer") {
//        window.location.href = "creer.html";
//      }
//    });
// const AnimText = document.querySelector("h1");

// const typewriter = new Typewriter(AnimText, {
//      loop: true ,
//      deleteSpeed:20
// })
// .changeDelay(50)
// .typeString("Bienvenue dans notre Jeu Quizzeo")
// .pauseFor(300)
// .start()

// Récupérer le titre dans l'URL
var params = new URLSearchParams(window.location.search);
var theme = params.get('theme');

// Afficher le titre dans la div
var divTheme = document.getElementById('theme-jeu');
divTheme.innerHTML = theme;
