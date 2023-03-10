const search = document.getElementById("container-search");

searchBox.addEventListener("input", function () {
  const query = searchBox.value.toLowerCase();
  const allCategories = document.querySelectorAll(".Categorie");

  allCategories.forEach(function (category) {
    const title = category.getAttribute("data-name").toLowerCase();

    if (title.includes(query)) {
      category.style.display = "block";
    } else {
      category.style.display = "none";
    }
  });
});