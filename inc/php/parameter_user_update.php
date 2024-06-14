<?php
    require_once("db.php");
    /*function headerWithError($errorMessage){
        header('HTTP/1.1 307 Temporary Redirect');
        header('location : signin.php?error_message=' . $errorMessage);
        exit;
    }*/

    if (isset($_POST['send'])) {
        /*if(!preg_match("/^(19[0-9][0-9])|(20[0-1][0-9])|(202[0-4])$/", $_POST['birthday-year']) || !preg_match("/^(0?[1-9]$)|(1[0-2])$/", $_POST['birthday-month']) || !preg_match("/^(0?[1-9]$)|([1-2][0-9])|(3[0-1])$/", $_POST['birthday-day'])) {
            headerWithError("La date de naissance est incorrecte.");
        } else if(!preg_match("/^(homme)|(femme)|(autre)$/", $_POST['sexe'])) {
            headerWithError("Le sexe est incorrect.");
        } else if(!preg_match("/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/", $_POST['email'])) {
            headerWithError("Le mail est incorrect.");
        } else if(!preg_match("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", $_POST["phone"])) {
            headerWithError("Le numéro de téléphone est incorrect.");
        }*/

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $sexe = $_POST['sexe'];
        $birthdayDay = $_POST['birthday-day'];
        $birthdayMonth = $_POST['birthday-month'];
        $birthdayYear = $_POST['birthday-year'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $newsletter = $_POST['newsletter'];
        $id_user= $_SESSION['id_user'];

        $dateNaissance = sprintf("%04d-%02d-%02d", $birthdayYear, $birthdayMonth, $birthdayDay);

        $sql = "UPDATE utilisateur SET
                    prenom = :firstName,
                    nom = :lastName,
                    pseudo = :username,
                    sexe = :sexe,
                    date_naissance = :dateNaissance,
                    mail = :email,
                    telephone = :phone,
                    statut_newsletter = :newsletter
                WHERE id_user = :id_user";

        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindValue(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':newsletter', $newsletter, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "L'utilisateur a été mis à jour avec succès.";
        } else {
            echo "Une erreur est survenue lors de la mise à jour de l'utilisateur.";
        }
    }
    if (isset($_POST['unsubscription'])) {
        $id_user= $_SESSION['id_user'];
        $sql2 = "UPDATE utilisateur SET
                    supprime =1
                WHERE id_user = :id_user";
        $stmt2 = $bdd->prepare($sql2);
        $stmt2->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
        if ($stmt2->execute()) {
            session_destroy();
            session_unset();
            header('Location: ../not_connected/home.php');
            exit();
        } else {
            echo "Une erreur est survenue lors de la supression de l'utilisateur.";
        }
    }

    if (isset($_POST['update-pass'])) {
        /*if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST['password'])) {
            headerWithError("Le mot de passe ne répond pas aux critères de sécurité exigés : " . $_POST['password']);
        }*/
        $password = $_POST['current-password'];
        $pepper = 'sZB8J0az0z';
    
        if ($password != "") {
            $id_user = $_SESSION['id_user'];
            $req1 = $bdd->prepare("SELECT mdp FROM utilisateur WHERE id_user = :id_user;");
            $req1->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            $req1->execute();
            $reponse2 = $req1->fetch(PDO::FETCH_ASSOC);
    
            if ($reponse2) {
                if (password_verify($password . $pepper, $reponse2['mdp'])) {
                    if ($_POST['new-password'] == $_POST['confirm-password']) {
                        $pepper2 = 'sZB8J0az0z';
                        $hash = password_hash($_POST['new-password'] . $pepper2, PASSWORD_BCRYPT, ['cost' => 13]);
                        $req2 = $bdd->prepare("UPDATE utilisateur SET mdp = :hash WHERE id_user = :id_user;");
                        $req2->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                        $req2->bindValue(':hash', $hash, PDO::PARAM_STR);
    
                        if ($req2->execute()) {
                            header("Location: parameters.php?mdp1=true");
                        } else {
                            header("Location: parameters.php?mdp0=true");
                        }
                    } else {
                        header("Location: parameters.php?2mdp0=true");
                    }
                } else {
                    header("Location: parameters.php?ex_mdp0=true");
                }
            }
        } else {
            echo "il faut saisir l'ancien mdp";
        }
    }

    
?>

