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

toggleSwitch.addEventListener("change", function() {
  if (toggleSwitch.checked) {
    user.classList.remove("animated");
    quizzer.classList.add("animated");
  } else {
    user.classList.add("animated");
    quizzer.classList.remove("animated");
  }
});
