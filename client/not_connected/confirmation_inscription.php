<?php
    session_start();
    require_once('../../inc/php/db.php');
    require_once('../../inc/db.php');
    echo 'slt';
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
            $sql = "INSERT INTO UTILISATEUR(role, nom, prenom, date_naissance, sexe, pseudo, mail, mdp, date_inscription, photo_utilisateur, statut_newsletter, code_verification, telephone, supprime)
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
            
            $req = $bdd->prepare("SELECT mail, mdp, id_user FROM UTILISATEUR WHERE mail = :email;");
            $req->execute(
                array(
                    "email" => $_POST['email']
                )
            );
            $reponse = $req->fetch();
            $_SESSION['email'] = $reponse['mail'];
            $_SESSION['id_user'] = $reponse['id_user'];
        } catch (PDOException $e) {
            //header('Location: signin.php?wrong_email=true');
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
    <?php require('../../inc/not_connected/header.php'); ?>

    <main>
        <div class="container-fluid d-flex justify-content-center">
            <div class="d-flex flex-column my-5 py-2 gap-5 text-center">
                <img src="../../inc/logo.svg" alt="Logo IDK" width="200px" height="200px" class="container-fluid img-thumbnail bg-transparent border-0">
                <h3 class="mt-5">En cours de confirmation<br>de la création du compte...</h3>
            </div>
        </div>
    </main>

    <?php require('../../inc/not_connected/footer.php'); ?>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/script.js"></script>
    <script>
        // Redirection après 5 secondes
        setTimeout(function() {
            window.location.href = 'confirmation_connexion.php';
        }, 5000);
    </script>
</body>

</html>