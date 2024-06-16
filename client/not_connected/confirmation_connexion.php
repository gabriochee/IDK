<?php require_once('../../inc/php/access.php'); ?>
<?php require_once('../../inc/php/function_connexion.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="not_connected_confirmation_connexion">
    <header class="container w-100 d-flex justify-content-end mt-5">
        <button class="nav-link btn">
            <i class="bi bi-moon-stars fs-3" height="100" width="100"></i>
        </button>
    </header>
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-3">
                    <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-4" width="150px" height="150px">
                </div>
            </div>
        </div>
        
        <div class="container col-sm-6 col-xl-4">
            <div class="row g-3">
                <form action="" class="needs-validation" method="POST">
                    <div class="text-center fs-4 mb-3">
                    <?php 
                        if (isset($_GET['wrong_code'])) {
                            echo "<div class='alert alert-danger' role='alert'>Le code est faux</div>";
                        }
                        if (isset($_GET['email_sent'])) {
                            echo "<div class='alert alert-success' role='alert'>Le mail de vérification a été envoyé</div>";
                        }
                        if (isset($_GET['mail_error'])) {
                            echo "<div class='alert alert-danger' role='alert'>Erreur lors de l'envoi du mail : " . htmlspecialchars(urldecode($_GET['error'])) . "</div>";
                        }
                        if (isset($_GET['update_failed'])) {
                            echo "<div class='alert alert-danger' role='alert'>Échec de la mise à jour du code de vérification</div>";
                        }
                        if (isset($_GET['db_error'])) {
                            echo "<div class='alert alert-danger' role='alert'>Erreur de base de données : " . htmlspecialchars(urldecode($_GET['error'])) . "</div>";
                        }
                        if (isset($_GET['no_user'])) {
                            echo "<div class='alert alert-danger' role='alert'>Utilisateur non trouvé</div>";
                        }
                        if (isset($_GET['wrong_role'])) {
                            echo "<div class='alert alert-danger' role='alert'>role faux contacter un administrateur avec contact</div>";
                        }
                    ?>

                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control p-2" id="username" placeholder="Veuillez entrer votre code envoyé par mail" name ="entrer_code" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir le code de vérification envoyé par mail.</div>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" type="submit" name="connect">Connexion</button>
                    </div>
                </form>
                <form action="confirmation_connexion.php" method="POST">
                    <div class="col-12">
                        <button class="w-100 btn btn-secondary btn-lg btn-warning border-dark border-2" type="buton" name="code">Envoyer le code par mail</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../../inclibrary/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>