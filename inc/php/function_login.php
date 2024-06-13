<?php
require_once('db.php');

if(isset($_POST['connecter'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $pepper = 'sZB8J0az0z';

    if($email != "" && $password != "") {
        //recup info de l'user qui veut se connecter
        $req1 = $bdd->prepare("SELECT id_user, nom, prenom, pseudo, mail, mdp, role_user FROM utilisateur WHERE mail = :email;");
        $req1->execute( array("email" => $email) );
        $reponse = $req1->fetch();


        if($reponse) {
            if(password_verify($password.$pepper, $reponse['mdp'])) {
                // Préparer la deuxième requête sans la virgule superflue
                $req2 = $bdd->prepare("SELECT supprime FROM utilisateur WHERE id_user = :id_user");
                $req2->bindValue(':id_user', $reponse['id_user'], PDO::PARAM_INT);
                $req2->execute();
                $supp_or_not = $req2->fetch(PDO::FETCH_ASSOC);
                
                if($supp_or_not && $supp_or_not['supprime'] == 1) {
                    header('Location: login.php?supprime=true');
                } else {
                    $date_now = date('Y-m-d H:i:s');

                    $req2 = $bdd->prepare("SELECT date_ban, date_deban, definitif, raison FROM ban WHERE id_user = :id_user ORDER BY id_ban DESC LIMIT 1");
                    $req2->bindValue(':id_user', $reponse['id_user'], PDO::PARAM_INT);
                    $req2->execute();
                    $ban_or_not = $req2->fetch(PDO::FETCH_ASSOC);
                    if($ban_or_not && $ban_or_not['definitif'] == 1){

                        //urlencode pour être sur que tous les caractères spéciaux soient pris en compte
                        $raison = urlencode($ban_or_not['raison']);

                        header("Location: login.php?ban_def=true&raison=$raison");
                    }else if($ban_or_not && $ban_or_not['definitif'] == 0 && $ban_or_not['date_deban'] > $date_now ){

                        $raison = urlencode($ban_or_not['raison']);
                        $date_deban = urlencode($ban_or_not['date_deban']);

                        header("Location: login.php?ban_not_def=true&raison=$raison&date_deban=$date_deban");
                    }
                    else{
                        $_SESSION['id_user'] = $reponse['id_user'];
                        $_SESSION['nom'] = $reponse['nom'];
                        $_SESSION['prenom'] = $reponse['prenom'];
                        $_SESSION['pseudo'] = $reponse['pseudo'];
                        $_SESSION['email'] = $email;
                        $_SESSION['role_user'] = $reponse['role_user'];
                        header('Location: confirmation_connexion.php');
                    }
                }
            } else {
                header('Location: login.php?wrong_mdp=true');
            }
        } else { 
            header('Location: login.php?wrong_email=true');
        }
    }
}

?>