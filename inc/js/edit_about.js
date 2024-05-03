document.getElementById("modifier-about").addEventListener("click", function() {
    var maDiv = document.getElementById("form-about");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});
