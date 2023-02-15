document.getElementById("quit").addEventListener("click", function()
{ 
     window.location.href = "/Projet-Quiz/html/Jeux.html";
});

document.getElementById("userType").addEventListener("change", function() {
     var selectedValue = this.value;
     if (selectedValue === "utilisateur") {
       window.location.href = "jouer.html";
     } else if (selectedValue === "quizzer") {
       window.location.href = "creer.html";
     }
   });