<?php
    session_start();
    require_once('../../inc/db.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pepper = 'sZB8J0az0z';
        $hash = password_hash($_POST['password'].$pepper, PASSWORD_BCRYPT, ['cost' => 13]);
        $today = date('Y-m-d');
        try{
            $sql = "INSERT INTO UTILISATEUR(role, nom, prenom, date_naissance, sexe, pseudo, mail, mdp, date_inscription, photo_utilisateur, statut_newsletter, code_verification)
                    VALUES ('utilisateur', :lastname, :firstname, :birthdate, :gender, :username, :mail, :hash, :today, 'N/A', 'abonne', NULL)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':lastname', $_POST['lastname']);
            $stmt->bindParam(':firstname', $_POST['firstname']);
            $birthdate = $_POST['birthday-year'] . '-' . $_POST['birthday-month'] . '-' . $_POST['birthday-day'];
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':gender', $_POST['gender']);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':mail', $_POST['mail']);
            $stmt->bindParam(':hash', $hash);
            $stmt->bindParam(':today', $today);
            $stmt->execute();
            
            $req = $bdd->prepare("SELECT mail, mdp, id_user FROM UTILISATEUR WHERE mail = :email;");
            $req->execute(
                array(
                    "email" => $_POST['mail']
                )
            );
            $reponse = $req->fetch();
            $_SESSION['email'] = $reponse['mail'];
            $_SESSION['id_user'] = $reponse['id_user'];
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            echo "Code erreur : " . $e->getCode();
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
    /*<script>
        // Redirection après 5 secondes
        setTimeout(function() {
            window.location.href = '../connected/home.php';
        }, 5000); 
    </script>
</body>

</html>