document.getElementById("modifier-home").addEventListener("click", function() {
    var maDiv = document.getElementById("form-home");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});
