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
