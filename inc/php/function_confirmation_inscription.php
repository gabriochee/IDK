<?php
    require_once('db.php');
    require_once('verify_signin_parameters.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $pepper = 'sZB8J0az0z';
        $hash = password_hash($_POST['password'].$pepper, PASSWORD_BCRYPT, ['cost' => 13]);
        $today = date('Y-m-d');
        if($_POST['newsletter'] == 1){
            $newsLetter = 1;
        }
        else
            $newsLetter=0;

        try{
            $sql = "INSERT INTO utilisateur(role, nom, prenom, date_naissance, sexe, pseudo, mail, mdp, date_inscription, photo_utilisateur, statut_newsletter, code_verification, telephone, supprime)
                    VALUES ('utilisateur', :lastname, :firstname, :birthdate, :gender, :username, :mail, :hash, :today, 'N/A', :abonne, NULL, :phone ,0)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':lastname', $_POST['lastName']);
            $stmt->bindParam(':firstname', $_POST['firstName']);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':gender', $_POST['sexe']);
            $birthdate = $_POST['birthday-year'] . '-' . $_POST['birthday-month'] . '-' . $_POST['birthday-day'];
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':mail', $_POST['email']);
            $stmt->bindParam(':phone', $_POST['phone']);
            $stmt->bindParam(':hash', $hash);
            $stmt->bindParam(':today', $today);
            $stmt->bindParam(':abonne', $newsLetter);
            $stmt->execute();
            
            $req = $bdd->prepare("SELECT mail, mdp, id_user FROM utilisateur WHERE mail = :email;");
            $req->execute(
                array(
                    "email" => $_POST['email']
                )
            );
            $reponse = $req->fetch();
            $_SESSION['email'] = $reponse['mail'];
            $_SESSION['id_user'] = $reponse['id_user'];
        } catch (PDOException $e) {
            header('Location: signin.php?wrong_email=true');
        }
    }
?>