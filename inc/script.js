// élément visuel pour affichage du formulaire dans le backoffice 
document.getElementById("modifier-home").addEventListener("click", function() {
    var maDiv = document.getElementById("form-home");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});
document.getElementById("modifier-terms").addEventListener("click", function() {
    var maDiv = document.getElementById("form-terms");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});
document.getElementById("modifier-about").addEventListener("click", function() {
    var maDiv = document.getElementById("form-about");
    if (maDiv.style.display === "none") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
});
