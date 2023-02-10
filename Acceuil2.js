const container = document.getElementById('container');
const loginButton = document.getElementById('login');
const signUpButton = document.getElementById('signUp');
const connectButton = document.getElementById('connect');
const registerButton = document.getElementById('register');

signUpButton.addEventListener('click', () => {
	container.classList.add('panel-active');
})

loginButton.addEventListener('click', () => {
	container.classList.remove('panel-active');
})

  const form = document.querySelector("form");
  form.addEventListener("submit", event => {
  event.preventDefault();
  window.location.href = "Jeux.html";
  });
  document.getElementById("connect").addEventListener("click", function(){
    window.location.href = "/Projet-Quiz/html/Jeux.html";
    });
const toggleSwitch = document.querySelector("#toggle-switch");
const user = document.querySelector("#user");
const quizzer = document.querySelector("#quizzer");
  toggleSwitch.addEventListener("change", function() {
    if (toggleSwitch.checked) {
       user.classList.remove("animated");
        quizzer.classList.add("animated");
    } else {
       user.classList.add("animated");
       quizzer.classList.remove("animated");
    }
  });