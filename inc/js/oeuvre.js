const cinq = document.getElementById("commentaire-cinq");
const quatre = document.getElementById("commentaire-quatre");
const trois = document.getElementById("commentaire-trois");
const deux = document.getElementById("commentaire-deux");
const un = document.getElementById("commentaire-un");
const zero = document.getElementById("commentaire-zero");

document.getElementById("note-cinq").addEventListener("click", function() {
        cinq.style.display = "block";
        quatre.style.display = "none";
        trois.style.display = "none";
        deux.style.display = "none";
        un.style.display = "none";
        zero.style.display = "none";
});
document.getElementById("note-quatre").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "block";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-trois").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "block";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-deux").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "block";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-un").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "block";
    zero.style.display = "none";
});
document.getElementById("note-zero").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "block";
});
    
const noConnectedElement = document.getElementById("no-connected");
noConnectedElement.addEventListener("click", function() {
    window.location.href = "../not_connected/signin.php";
});