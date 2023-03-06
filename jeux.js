
const body = document.querySelector('body'),
sidebar = body.querySelector('nav'),
toggle = body.querySelector(".toggle"),
searchBtn = body.querySelector(".search-box"),
modeSwitch = body.querySelector(".toggle-switch"),
modeText = body.querySelector(".mode-text");


let mainButtons = document.querySelectorAll(".containers button");
let subButtons = document.querySelectorAll(".containers2 button");

function hideAllSubButtons() {
  for (let i = 0; i < subButtons.length; i++) {
    subButtons[i].style.display = "none";
    subButtons[i].classList.remove("show");
  }
}

for (let i = 0; i < mainButtons.length; i++) {
  mainButtons[i].addEventListener("click", function() {
    hideAllSubButtons();
    let subButtonToShow = subButtons[i];
    subButtonToShow.style.display = "flex";
    subButtonToShow.classList.add("show");
    cards.forEach(cards => {
      card.style.transform = `translateX(${sidebar.classList.contains('active') ? '250px' : '0'})`;
    });
  });
}

toggle.addEventListener("click" , () =>{
sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
body.classList.toggle("dark");

if(body.classList.contains("dark")){
modeText.innerText = "Light mode";
}else{
modeText.innerText = "Dark mode";

}
});
