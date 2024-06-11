<?php
require_once('db.php');

if(isset($_POST['connecter'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $pepper = 'sZB8J0az0z';

    if($email != "" && $password != "") {

        $req = $bdd->prepare("SELECT id_user, nom, prenom, pseudo, mail, mdp, role_user FROM utilisateur WHERE mail = :email;");
        $req->execute( array("email" => $email) );
        $reponse = $req->fetch();

        if($reponse) {
            
            if(password_verify($password.$pepper, $reponse['mdp'])) {
                $req2 = $bdd->prepare("SELECT definitif, id_ban, date_ban, probleme, date_deban FROM ban WHERE id_ban = :id_ban;");
                $req2->execute( array("id_ban" => $reponse['id_user']));
                $ban_ou_pas=$req2->fetch();

                $date_today = date('Y-m-d H:i:s');
                $_SESSION['start'] = $date_today;
                $_SESSION['id_user'] = $reponse['id_user'];
                $_SESSION['nom'] = $reponse['nom'];
                $_SESSION['prenom'] = $reponse['prenom'];
                $_SESSION['pseudo'] = $reponse['pseudo'];
                $_SESSION['email'] = $email;
                $_SESSION['role_user'] = $reponse['role_user'];

                if($ban_ou_pas['probleme'] == 1) {

                    if($date_today >= $ban_ou_pas['date_deban']) {
                        $req4 = $bdd->prepare("UPDATE ban SET probleme = :probleme WHERE id_ban = :id_ban;");
                        $req4->execute( array("probleme" => 0, "id_ban" => $_SESSION['id_user']) );
                    }

                    $req5 = $bdd->prepare("SELECT probleme FROM ban WHERE id_ban = :id_ban;");
                    $req5->execute( array("id_ban" => $reponse['id_user']) );
                    $maj_probleme=$req5->fetch();
                    
                    if($maj_probleme['probleme'] == 0) {
                        header('Location: confirmation_connexion.php');
                    } else if($ban_ou_pas['definitif'] == 1) {       
                        header('Location: login.php?ban_def');
                    } else if($ban_ou_pas['definitif'] == 0) {
                        header('Location: login.php?ban');
                    } else {
                        echo 'Rien';
                    }
                } else {
                    header('Location: confirmation_connexion.php');
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