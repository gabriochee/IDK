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
    <?php require_once('../../inc/php/function_login.php');?>
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
            <form action="login.php" class="needs-validation" method="post">
                <div class="container px-sm-4 col-sm-10">
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="Addresse email/pseudo" name ="email" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un pseudo ou email valide.</div>
                </div>

                <div class="container px-sm-4 col-sm-10">
                    <input type="password" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-bottom text-center py-3" name="password" id="password" placeholder="Mot de passe" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>
                <div class="text-center fs-4">
                    <?php
                        $req3 = $bdd->prepare("SELECT raison, date_ban, date_deban FROM ban WHERE id_ban = :id_ban;");
                        
                        $req3->execute(
                            array(
                                "id_ban" => $_SESSION['id_user']
                            )
                        );
                        $ban_info=$req3->fetch();
                        if (isset($_GET['wrong_email'])){
                            echo "L'email ou le mot de passe ou les deux sont erronés";
                        }
                        
                        if (isset($_GET['wrong_mdp'])){
                            echo "L'email ou le mot de passe ou les deux sont erronés";
                            
                        }
                        if(isset($_GET['ban_def'])){
                            echo "Ton compte a été ban_def pour le motif suivant: " . $ban_info['raison'];
                        }
                        if(isset($_GET['ban'])){
                            echo "Ton compte a été ban jusqu'au: " .$ban_info['date_deban'] ." pour la raison suivante: ". $ban_info['raison'];
                        }
                    ?>
                </div>
                

                <div class="container px-sm-4 col-sm-10 mt-4">
                    <button class="btn btn-lg w-100 py-2 fs-4 btn-warning border-dark border-2" type="submit" name="connecter">
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
</body>
</html>