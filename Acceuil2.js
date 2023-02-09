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
connectButton.addEventListener("click", function() {
	window.location.replace("http://127.0.0.1:5500/Projet-Quiz/html/Jeux.html");
  });
