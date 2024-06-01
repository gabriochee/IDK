<?php
    require('db.php');

    if (isset($_POST['connecter'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pepper = 'sZB8J0az0z';
        if($email != "" && $password != ""){
            $req = $bdd->prepare("SELECT mail, mdp, id_user FROM utilisateur WHERE mail = :email;");
            $req->execute(
                array(
                    "email" => $email
                )
            );
            $reponse = $req->fetch();
            //si $reponse renvoie une valeur ca veut dire que le mail est dans la BDD
            if($reponse){
                
                
                if(password_verify($password.$pepper, $reponse['mdp'])){
                    $req2 = $bdd->prepare("SELECT definitif,id_ban,date_ban,probleme, date_deban FROM ban WHERE id_ban = :id_ban;");
                    $req2->execute(
                        array(
                            "id_ban" => $reponse['id_user']
                        )
                    );
                    $ban_ou_pas=$req2->fetch();
                    $_SESSION['email'] = $email;
                    $_SESSION['id_user'] = $reponse['id_user'];
                    $date_today = date('Y-m-d H:i:s');
                    //vérifie si l'utilisateur est toujours ban ou non a la connection s'il n'est plus ban
                    // l'attribut problème change et lui permet a nouveau de se connecter
                    
                    //je vérifie si c'est un utilisateur avec un problème donc soit ban soit supprime
                    if($ban_ou_pas['probleme']==1){
                        if($date_today >= $ban_ou_pas['date_deban']){
                            
                            $req4 = $bdd->prepare("UPDATE ban SET probleme = :probleme WHERE id_ban = :id_ban;");
                            $req4->execute(
                                array(
                                    "probleme" => 0,
                                    "id_ban" => $_SESSION['id_user']
                                )
                            );
                            
                        }
                        $req5 = $bdd->prepare("SELECT probleme FROM ban WHERE id_ban = :id_ban;");
                        $req5->execute(
                            array(
                                "id_ban" => $reponse['id_user']
                            )
                        );
                        $maj_probleme=$req5->fetch();
                        if($maj_probleme['probleme']==0){
                            header('Location: confirmation_connexion.php');
                        }
                        //definif =1 supprimé definitif =0 ban 
                        else if($ban_ou_pas['definitif']==1){
                            
                            header('Location: login.php?ban_def');
                        }
                        else if($ban_ou_pas['definitif']==0){
                            
                            header('Location: login.php?ban');
                        }
                        else{
                            echo 'rien';
                        }
                    }
                    else{
                        header('Location: confirmation_connexion.php');
                    }
                    
                }else {
                    header('Location: login.php?wrong_mdp=true');
                }

            }
            //si le mail entré n'st pas dans la BDD alors mail faux mais en dit que c mail ou mdp faux 
            else{
                header('Location: login.php?wrong_email=true');
            }
        }
    }
?>