<?php
require_once('db.php');
session_start();

global $dbh;
if (isset($_POST['connecter'])) {
    $email = $_POST['email'];
    var_dump($email);
    $password = $_POST['password'];
    if($email != "" && $password != ""){
        $req = $bdd->query("SELECT * FROM UTILISATEUR WHERE mail = '$email';");
        $reponse = $req->fetch();
        $_SESSION['email'] = $email;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

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
        <div class="container-fluid d-flex justify-content-center my-5 py-2">
            <img src="../../inc/logo.svg" alt="Logo IDK" class="img-thumbnail bg-transparent border-0">
        </div>

        <div class="container col-sm-6 col-xl-4">
            <form action="./confirmation_connexion.php" class="needs-validation" method="post">
                <div class="container px-sm-4 col-sm-10">
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="Addresse email/pseudo" name ="email" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un pseudo ou email valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-10">
                    <input type="password" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-bottom text-center py-3" name="password" id="password" placeholder="Mot de passe" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name ="connecter">
                        Connexion
                    </button>
                </div>

                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 mt-5 fs-4 btn-warning border-dark border-2" type="submit">
                        S'inscrire
                    </button>
                    <button class="btn btn-lg w-100 py-2 my-2 fs-4 btn-warning border-dark border-2" type="submit">
                        Mot de passe oublié
                    </button>
                </div>
            </form>
        </div>
    </main>

<script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../inc/script.js"></script>
</body>
</html>