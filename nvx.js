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


const toggleSwitch = document.querySelector('.toggle-switch input[type="checkbox"]');
    toggleSwitch.addEventListener('change', function() {
        if (this.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            // Enregistrer l'état du mode sombre dans la variable de session
            $.ajax({
                url: 'save_dark_mode.php',
                type: 'post',
                data: { dark_mode: 'on' },
                success: function(response) {
                    console.log(response);
                }
            });
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            // Enregistrer l'état du mode sombre dans la variable de session
            $.ajax({
                url: 'save_dark_mode.php',
                type: 'post',
                data: { dark_mode: 'off' },
                success: function(response) {
                    console.log(response);
                }
            });
        }    
    });