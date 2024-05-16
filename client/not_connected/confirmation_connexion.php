<?php
    session_start();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body>
    <header class="container w-100 d-flex justify-content-end mt-5">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <?php require('../../inc/php/function_confirmation_connexion.php') ?>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                </div>
            </div>
        </div>

        <div class="container col-sm-6 col-xl-4">


            <form action="confirmation_connexion.php" class="needs-validation" method="POST">
                <div class="container px-sm-4 col-sm-10">
                    <label for="entrer_code">Veuillez entrer votre code envoyé par mail</label>
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="" name ="entrer_code" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir le code de vérification envoyé par mail.</div>
                </div>

                <div class="text-center">
                    <?php 
                    //vérifies si wrong_code existe et si elle est = a true
                        if (isset($_GET['wrong_code'])&& $_GET['wrong_code'] === 'true'){
                            echo "Le code est faux";
                        }
                        
                        if (isset($_GET['email_sent']) && $_GET['email_sent'] === 'true') {
                            echo 'le mail de vérification a été envoyé';
                        }
                    ?>
                </div>

                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name ="connect">
                        Connexion
                    </button>
                </div>
            </form>


            <form action="confirmation_connexion.php" method="POST">
                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="buton" name ="code">
                        envoyer le code par mail
                    </button>
                </div>
            </form>
                
        </div>
    </main>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>