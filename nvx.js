const body = document.querySelector('body');
const sidebar = body.querySelector('nav');
const toggle = body.querySelector(".toggle");
const searchBtn = body.querySelector(".search-box");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode-text");
const images = document.querySelectorAll('.test img');
const imageSwitch = document.querySelector('.toggle-switch-image');

toggle.addEventListener("click", () => {
sidebar.classList.toggle("close");
});

searchBtn.addEventListener("click", () => {
sidebar.classList.remove("close");
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