document.getElementById("modifier-terms").addEventListener("click", function() {
    var maDiv = document.getElementById("form-terms");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});