<?php
session_start();
require_once('../../inc/db.php');

if (isset($_POST['connecter'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pepper = 'sZB8J0az0z';
    if($email != "" && $password != ""){
        $req = $bdd->prepare("SELECT mail, mdp, id_user FROM UTILISATEUR WHERE mail = :email;");
        $req->execute(
            array(
                "email" => $email
            )
        );
        $reponse = $req->fetch();
        
        if($reponse){
            if (password_verify($password.$pepper, $reponse['mdp'])){
                $_SESSION['email'] = $email;
                $_SESSION['id_user'] = $reponse['id_user'];
                header('Location: confirmation_connexion.php');
            } else {
            header('Location: login.php?wrong_mdp=true');
            }
        } else {
            header('Location: login.php?wrong_email=true');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/functions.php">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body>
    <header class="container w-100 d-flex justify-content-end mt-5 h-100">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
    <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>

        <div class="container col-sm-6 col-xl-4">
            <form action="./login.php" class="needs-validation" method="post">
                <div class="form-floating">
                    <input type="email" class="form-control fs-4 minimize-input" id="username" name ="email" value="" required="">
                    <label for="floatingInput">Addresse email</label>
                    <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control fs-4 minimize-input" name="password" id="password" value="" required="">
                    <label for="floatingPassword">Mot de passe</label>
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>
                <div class="text-center">
                    <?php 
                        if (isset($_GET['wrong_email'])){ echo "L'email n'existe pas "; }
                        if (isset($_GET['wrong_mdp'])){ echo "Le mot de passe est faux"; }
                    ?>
                </div>
                
                <button class="w-100 btn btn-warning border-dark mt-4" type="submit" name="connecter">Connexion</button>
                <button class="w-100 btn btn-warning border-dark mt-1" type="submit" name="connecter">S'inscrire</button>
                <button class="w-100 btn btn-warning border-dark mt-1" type="submit" name="connecter">Mot de passe oublié</button>
            </form>
        </div>
    </main>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>