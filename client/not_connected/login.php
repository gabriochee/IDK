<?php

session_start();
require_once('../../inc/db.php');

if (isset($_POST['connecter'])) {
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
        var_dump($reponse);
        //si $reponse renvoie une valeur ca veut dire que le mail est dans la BDD
        if($reponse){
            $req2 = $bdd->prepare("SELECT definitif,id_banni,date_ban,probleme FROM BAN WHERE id_banni = :id_user;");
            $req2->execute(
                array(
                    "id_user" => $reponse['id_user']
                )
            );
            $ban_ou_pas=$req2->fetch();
            var_dump($ban_ou_pas['probleme']);
            $_SESSION['email'] = $email;
            $_SESSION['id_user'] = $reponse['id_user'];
            //je vérifie si c'est un utilisateur avec un problème = ban ou supprime 
            //si le ban est fini on met l'attribut problème à 0;
            if($ban_ou_pas['probleme']==1){
                if($ban_ou_pas['definitif']==1){
                    header('Location: login.php?supprime');
                }
                if($ban_ou_pas['definitif']==0){
                    header('Location: login.php?ban');
                }
            }
            // si aucun problème je lui laisse l'accès
            else{
                if(password_verify($password.$pepper, $reponse['mdp'])){
                    header('Location: confirmation_connexion.php');
                }else {
                    header('Location: login.php?wrong_mdp=true');
                }
            }
        }
        //si le mail entré n'st pas dans la BDD alors mail faux mais en dit que c mail ou mdp faux 
        else{
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
                        $req3 = $bdd->prepare("SELECT raison, date_ban, duree, DATE_ADD(date_ban, INTERVAL duree DAY) AS date_deban FROM BAN WHERE id_banni = :id_user;");

                        $req3->execute(
                            array(
                                "id_user" => $_SESSION['id_user']
                            )
                        );
                        $ban_info=$req3->fetch();
                        if (isset($_GET['wrong_email'])){
                            echo "L'email ou le mot de passe ou les deux sont erronés";
                        }
                        
                        if (isset($_GET['wrong_mdp'])){
                            echo "L'email ou le mot de passe ou les deux sont erronés";
                            
                        }
                        if(isset($_GET['supprime'])){
                            echo "Ton compte a été supprimé pour le motif suivant: " . $ban_info['raison'];
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