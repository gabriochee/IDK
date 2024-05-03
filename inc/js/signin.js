let signin_form = document.getElementById('signin-form');
let password = document.getElementById('password');

signin_form.addEventListener('submit', function(event){
    event.preventDefault();
    if (password.value.length < 8){
        alert("Votre mot de passe est inférieur à 8 caractères. Fournissez en un plus grand.");
    } else if (password.value !== document.getElementById('password-confirmation').value){
        alert("Le mot de passe de confirmation est différent du mot de passe.");
    } else {
        signin_form.submit();
    }
});