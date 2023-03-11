const searchBox = document.getElementById("searchBox");

searchBox.addEventListener("input", function () {
  const query = searchBox.value.toLowerCase();
  const allCategories = document.querySelectorAll(".textBox");

  allCategories.forEach(function (category) {
    const title = category.querySelector(".h1").textContent.toLowerCase();

    if (title.includes(query)) {
      category.parentElement.style.display = "block";
    } else {
      category.parentElement.style.display = "none";
    }
  });
});
