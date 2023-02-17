const container = document.getElementById('container');
const loginButton = document.getElementById('login');
const signUpButton = document.getElementById('signUp');
const connectButton = document.getElementById('connect');
const registerButton = document.getElementById('register');
const toggleSwitch = document.querySelector("#toggle-switch");
const user = document.querySelector("#user");
const quizzer = document.querySelector("#quizzer");

signUpButton.addEventListener('click', () => {
	container.classList.add('panel-active');
})

loginButton.addEventListener('click', () => {
	container.classList.remove('panel-active');
})

// document.getElementById("button1").addEventListener("click", function(){
//   window.location.href = "/Projet-Quiz/html/Jeux.html";
// });
// document.getElementById("button2").addEventListener("click", function(){
//   window.location.href = "/Projet-Quiz/html/Jeux.html";
// });





// Récupération du bouton "Créer un compte"
// var bouton2 = document.getElementById("button2");

// Ajout d'un événement "click" au bouton "Créer un compte"
// bouton2.addEventListener("click", function(event) {
    // event.preventDefault(); // Empêcher la soumission du formulaire par défaut

    // Récupération des données du formulaire
    // var pseudo = document.getElementsByName("pseudo")[0].value;
    // var email = document.getElementsByName("email")[0].value;
    // var motdepasse = document.getElementsByName("pswd")[0].value;
    // var role = document.getElementsByName("role")[0].value;

    // Création d'une requête HTTP POST vers le script PHP
    // var xhr = new XMLHttpRequest();
    // xhr.open("POST", "/Projet-Quiz/html/connexion.php", true);
    // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Envoi des données du formulaire au script PHP
    // xhr.send("pseudo=" + pseudo + "&email=" + email + "&pswd=" + motdepasse + "&role=" + role)});






// document.getElementById("button2").addEventListener("click", function(){
//   document.getElementById("userType").addEventListener("change", function() {
//     var selectedValue = this.value;
//     if (selectedValue === "utilisateur") {
//       window.location.href = "/Projet-Quiz/html/Jeux.html";
//     } else if (selectedValue === "quizzeur") {
//       window.location.href = "/Projet-Quiz/html/Jeux2.html";
//     }
//   });
// });

// toggleSwitch.addEventListener("change", function() {
//   if (toggleSwitch.checked) {
//     user.classList.remove("animated");
//     quizzer.classList.add("animated");
//   } else {
//     user.classList.add("animated");
//     quizzer.classList.remove("animated");
//   }
// });});
