<?php session_start() ?>
<?php require_once('../../inc/php/scraping_log.php'); ?>

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
<body id="not_connected_login">
    <?php require_once('../../inc/php/function_login.php');?>
    <header class="container w-100 d-flex justify-content-end mt-5 h-100">
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
                <form action="login.php" class="needs-validation" method="POST">
                    <div class="col-12">
                        <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-2" id="username" placeholder="Addresse email/pseudo" name ="email" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un pseudo ou email valide.</div>
                    </div>
                    <div class="col-12 mt-1">
                        <input type="password" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-bottom text-center py-2" name="password" id="password" placeholder="Mot de passe" value="" required="">
                        <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                    </div>
                    <div class="text-center fs-4">
                    <?php
                        if(isset($_SESSION['id_user'])) {
                            $req3 = $bdd->prepare("SELECT raison, date_ban, date_deban FROM ban WHERE id_ban = :id_ban;");
                            $req3->execute( array("id_ban" => $_SESSION['id_user']) );
                            $ban_info = $req3->fetch();
                        }
                        if(isset($_GET['wrong_email'])) {echo "L'email ou le mot de passe ou les deux sont erronés";}
                        if(isset($_GET['wrong_mdp'])) {echo "L'email ou le mot de passe ou les deux sont erronés";}
                        if(isset($_GET['ban_def'])) {echo "Ton compte a été ban_def pour le motif suivant: " . $ban_info['raison'];}
                        if(isset($_GET['ban'])) {echo "Ton compte a été ban jusqu'au: " .$ban_info['date_deban'] ." pour la raison suivante: ". $ban_info['raison'];}
                    ?>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name="connecter">Connexion</button>
                    </div>
                </form>
                <div class="col-12">
                    <button class="btn btn-lg w-100 py-2 mt-3 fs-4 btn-warning border-dark border-2" type="submit" onclick="window.location='signin.php'">S'inscrire</button>
                </div>
                <div class="col-12 mt-1">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit">Mot de passe oublié</button>
                </div>
            </div>
        </div>
    </main>
    <script src="../../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>