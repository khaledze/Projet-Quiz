
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
  });
}


