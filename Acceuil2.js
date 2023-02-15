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

document.getElementById("button1").addEventListener("click", function(){
  window.location.href = "/Projet-Quiz/html/Jeux.html";
});
document.getElementById("button2").addEventListener("click", function(){
  window.location.href = "/Projet-Quiz/html/Jeux.html";
});

// document.getElementById("button2").addEventListener("click", function(e) {
//   e.preventDefault();
//   var username = document.getElementById("username").value;
//   var password = document.getElementById("password").value;
//   // Vérifier les entrées de l'utilisateur ici
//   fetch("connexion.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/x-www-form-urlencoded"
//     },
//     body: `username=${username}&password=${password}&email=${email}`
//   })
//     .then(response => response.json())
//     .then(data => {
//       if (data.success){ 
//           window.location.href = "/Projet-Quiz/html/Jeux.html";
//       } else {
//         print("error");
//       }
//     });
// });


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
// document.getElementById("button2").addEventListener("click", function(e) {
//   e.preventDefault();
//   var selectedValue = document.getElementById("userType").value;
//   var username = document.getElementById("username").value;
//   var email = document.getElementById("email").value;
//   var password = document.getElementById("password").value;
//   fetch("register.php", {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/x-www-form-urlencoded"
//     },
//     body: `username=${username}&password=${password}&email=${email}&userType=${selectedValue}`
//   })
//   .then(response => response.json())
//   .then(data => {
//     if (data.success) {
//       if (selectedValue === "utilisateur") {
//         window.location.href = "/Projet-Quiz/html/Jeux.html";
//       } else if (selectedValue === "quizzeur") {
//         window.location.href = "/Projet-Quiz/html/Jeux2.html";
//       }}
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
document.querySelector("#button2").addEventListener("click", function(event) {
  event.preventDefault();
  const username = document.querySelector("#username").value;
  const email = document.querySelector("#email").value;
  const password = document.querySelector("#password").value;
  const userType = document.querySelector("#userType").value;
  const formData = new FormData();
  formData.append("username", username);
  formData.append("email", email);
  formData.append("password", password);
  formData.append("userType", userType);

  fetch("connexion.php", {
      method: "POST",
      body: formData
  })
      .then(response => response.json())
      .then(data => {
          console.log(data);
      })
      .catch(error => {
          console.error("Error:", error);
      });
});


