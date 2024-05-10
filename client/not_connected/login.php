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
            <form action="./login.php" class="needs-validation" method="post">
                <div class="container px-sm-4 col-sm-10">
                    <input type="text" class="form-control fs-4 minimize-input border-dark border-2 rounded-0 rounded-top text-center py-3" id="username" placeholder="Addresse email/pseudo" name ="email" value="" required="">
                    <div class="invalid-feedback">Veuillez fournir un pseudo ou email valide.</div>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control fs-4 minimize-input" name="password" id="password" value="" required="">
                    <label for="floatingPassword">Mot de passe</label>
                    <div class="invalid-feedback">Veuillez fournir un mot de passe valide.</div>
                </div>
                <div class="text-center">
                    <?php 
                        if (isset($_GET['wrong_email'])){
                            echo "L'email n'existe pas ";
                        }
                        
                        if (isset($_GET['wrong_mdp'])){
                            echo 'coucou';
                            echo "Le mot de passe est faux";
                            
                        }
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